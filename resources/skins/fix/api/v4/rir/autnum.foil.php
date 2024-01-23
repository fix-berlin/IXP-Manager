password: <?= config('ixp_api.rir.password') ?>


aut-num:        198136
as-name:        FIX-RS
descr:          FIX Berlin Routeservers
org:            ORG-SEPC3-RIPE
sponsoring-org: ORG-ACP10-RIPE
<?php foreach( $t->asns as $asn => $details ): ?>
import:         from AS<?= $asn ?> accept <?= $details[ "asmacro" ] ?> # <?= $details[ "name" ] ?>

export:         to   AS<?= $asn ?> announce AS198136:AS-RS-PEERS
<?php endforeach; ?>
admin-c:        SN9448-RIPE
tech-c:         SN9448-RIPE
status:         ASSIGNED
mnt-by:         FIX-AUTO-MNT
mnt-by:         SEPC-MNT
source:         RIPE
