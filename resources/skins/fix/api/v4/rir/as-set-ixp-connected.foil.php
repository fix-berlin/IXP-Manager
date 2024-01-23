password: <?= config('ixp_api.rir.password') ?>


as-set:         AS198136:AS-PEERS
descr:          FIX Berlin Peers
admin-c:        SN9448-RIPE
tech-c:         SN9448-RIPE
remarks:        IXP member ASNs connected to the route servers are listed in AS198136:AS-CONNECTED
<?php foreach( $t->asns as $asn => $details ): ?>
members:        <?= $details[ "asmacro" ] ?>

<?php endforeach; ?>
mnt-by:         FIX-AUTO-MNT
mnt-by:         SEPC-MNT
source:         RIPE
