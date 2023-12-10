<?php
/*
 * Bird Route Server Configuration Template
 *
 *
 * You should not need to edit these files - instead use your own custom skins. If
 * you can't effect the changes you need with skinning, consider posting to the mailing
 * list to see if it can be achieved / incorporated.
 *
 * Skinning: https://ixp-manager.readthedocs.io/en/latest/features/skinning.html
 *
 * Copyright (C) 2009 - 2019 Internet Neutral Exchange Association Company Limited By Guarantee.
 * All Rights Reserved.
 *
 * This file is part of IXP Manager.
 *
 * IXP Manager is free software: you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation, version v2.0 of the License.
 *
 * IXP Manager is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for
 * more details.
 *
 * You should have received a copy of the GNU General Public License v2.0
 * along with IXP Manager.  If not, see:
 *
 * http://www.gnu.org/licenses/gpl-2.0.html
 */
?>

########################################################################################
########################################################################################
#
# Standard IXP community filter
#
########################################################################################
########################################################################################


function ixp_community_filter(int peerasn)
{
    if !(source = RTS_BGP) then
            return false;

    # AS path prepending
    if (routeserverasn, 103, peerasn) ~ bgp_large_community then {
        bgp_path.prepend( bgp_path.first );
        bgp_path.prepend( bgp_path.first );
        bgp_path.prepend( bgp_path.first );
    } else if (routeserverasn, 102, peerasn) ~ bgp_large_community then {
        bgp_path.prepend( bgp_path.first );
        bgp_path.prepend( bgp_path.first );
    } else if (routeserverasn, 101, peerasn) ~ bgp_large_community then {
        bgp_path.prepend( bgp_path.first );
    }

    # support for BGP Large Communities
    if (routeserverasn, 0, peerasn) ~ bgp_large_community then
            return false;
    if (routeserverasn, 1, peerasn) ~ bgp_large_community then
            return true;
    if (routeserverasn, 0, 0) ~ bgp_large_community then
            return false;
    if (routeserverasn, 1, 0) ~ bgp_large_community then
            return true;

    # FIX: NO_EXPORT to specific peers
    if (routeserverasn, 901, 0) ~ bgp_large_community then {
        bgp_community.add((65535, 0xFF01));
    } else if (routeserverasn, 901, peerasn) ~ bgp_large_community then {
        bgp_community.add((65535, 0xFF01));
    }

    # FIX: NO_ADVERTISE to specific peers
    if (routeserverasn, 902, 0) ~ bgp_large_community then {
        bgp_community.add((65535, 0xFF02));
    } else if (routeserverasn, 902, peerasn) ~ bgp_large_community then {
        bgp_community.add((65535, 0xFF02));
    }

    # Implement the traditional don't export to peer community for 16-bit ASNs
    if peerasn > 65535 then
            return true;
    if (0, peerasn) ~ bgp_community then
            return false;
    return true;
}

