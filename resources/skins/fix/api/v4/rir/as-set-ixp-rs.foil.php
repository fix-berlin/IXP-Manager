password: <?= config('ixp_api.rir.password') ?>


as-set:         AS198136:AS-RS-PEERS
descr:          ASNs connected to the Route Server system at IXP
admin-c:        SN9448-RIPE
tech-c:         SN9448-RIPE
remarks:        IXP member ASNs are listed in AS198136:AS-CONNECTED
<?php foreach( $t->customers as $c ): ?>
<?php if( $c->routeServerClient( ) ): ?>
members:        <?= $c->asMacro( 4, 'AS' ) ?>

<?php endif; ?>
<?php endforeach; ?>
mnt-by:         FIX-AUTO-MNT
mnt-by:         SEPC-MNT
source:         RIPE
