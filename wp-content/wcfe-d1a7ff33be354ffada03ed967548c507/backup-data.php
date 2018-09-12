<?php

# No direct access
$secureSrcClassName  = 'WCFE\Modules\Editor\Model\EmergencyRestore';
( class_exists( $secureSrcClassName ) && ( get_class( $this ) == $secureSrcClassName ) ) or die( 'Access Denied' );

$data = array();

$data[ 'secureKey' ] 	= 'c20a99412d8f84112f73b1b10a918207';
$data[ 'backupFileHash' ] 	= '4458950d8f01443a7b08ac366e6c0de5';

$data[ 'absPath' ] 	= '/var/www/iguideyou.tours/html';
$data[ 'contentDir' ] 	= '/var/www/iguideyou.tours/html/wp-content/wcfe-d1a7ff33be354ffada03ed967548c507';

$data[ 'timeCreated' ] 	= 1536673379;

$data[ 'privateKey' ] = 'yHeb#I0j}d*zTnZV{v[_:.sA0[c(D>0#B*>k%D^X7MqqL.[](_E&H{<*P5Z~/^CoTD+DgMhWTcON)Ks~|Go.[TuEa=1ncwMY{n}yDk308YT^^?gZNdfsBVNSgD91z50^u,Xc,$hu_`_sg*{v^} _ui1u-Fb{ ?</vih}Vi%Zs6%4 mwl@(y)f]OZHF3[_3*pJV#?qI]`e9ZBw9<jAL+o2mB-}==.Xq&hVSq1EBy^4r07]64sm<#|&nzCS#Chp#YPIad~Lb9J+im)XyMPpPtsvDw-S<ueW&7]eoG7+o/%M2Pbba0%G!tR7:W`;ATjcde8Oopk$mCC+K7ZM7u$gh8*-ZPY:}Dvbfs3hN/~D%V_jcCBsdPr9NS!_cn.4>EDzs/X~=9_M}s&T4%qM=k_YDUIkSV_S_NDlH%.Uqdk)au<(%~WR-ZGZ5i?z%Sv{RKv]R-=]p?eVXi/.Ek$Hmzi~@&yC=]HJ;P9iqTPvCxe{W^?joYW.T:}CWP>/J>u9aJASS;u';

return $data;