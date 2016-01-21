/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.16 : Database - sugar
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sugar` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `sugar`;

/*Table structure for table `activity` */

DROP TABLE IF EXISTS `activity`;

CREATE TABLE `activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `content_id` int(11) NOT NULL,
  `data` text NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `type` (`type`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

/*Data for the table `activity` */

insert  into `activity`(`id`,`user_id`,`type`,`content_id`,`data`,`time`) values (1,1015,'1',11,'ccccccccccc',1384159586),(3,1015,'2',0,'3',1387448565),(4,1015,'2',0,'3',1387448578),(5,1015,'1',11,'ccccccccccc',1387448778),(6,1017,'1',15,'Test blog',1395998137),(7,1017,'1',0,'Post dating 01',1403230654),(8,1017,'1',0,'Check',1404352126),(9,1017,'1',0,'Dating kaka',1406521536),(10,1017,'1',16,'Test blog',1406522562),(11,1017,'1',17,'Test blog',1406622018),(12,1017,'1',18,'asd asdas',1406622579),(13,1017,'1',19,'sdadasdas',1406622709),(14,1017,'1',20,'adad adad',1406622726),(15,1017,'1',0,'',1409728390),(16,1017,'1',0,'',1409728763),(17,1017,'1',0,'',1409728767),(18,1017,'1',0,'',1409728835),(19,1017,'1',0,'',1409728901),(20,1017,'1',0,'',1409728996),(21,1017,'1',0,'',1409729399),(22,1017,'1',0,'',1409729534),(23,1017,'1',0,'sdadasd',1409729936),(24,1017,'1',0,'dfdsfdsfsdfsdf',1409729958),(25,1017,'1',0,'asdsadasd',1409730023),(26,1023,'1',21,'Test blog',1409735519),(27,1023,'1',0,'Thu',1409795955),(28,1023,'1',0,'Thu',1409801113),(29,1017,'1',0,'Check 111111',1412220547),(30,1017,'1',22,'Check blog',1412567701),(31,1023,'1',0,'Moi VIP Cuong Cuong',1413952403);

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `last_login` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `publish` tinyint(4) NOT NULL,
  `ordering` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `admin` */

insert  into `admin`(`id`,`email`,`password`,`name`,`last_login`,`time`,`publish`,`ordering`) values (1,'thanh.trung@mwc.vn','e10adc3949ba59abbe56e057f20f883e','Nguyễn Thành Trung',1401693618,0,1,0),(5,'admin@sugardating.dk','271860f216a77e671de80937245f4945','Administrator',0,1385631921,1,0),(6,'admin','1bbd886460827015e5d605ed44252251','Le Cuong',1413944457,0,1,0);

/*Table structure for table `article` */

DROP TABLE IF EXISTS `article`;

CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `alias` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `short_content` text NOT NULL,
  `full_content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `time` int(11) NOT NULL,
  `publish` int(11) NOT NULL,
  `ordering` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

/*Data for the table `article` */

insert  into `article`(`id`,`title`,`alias`,`category_id`,`short_content`,`full_content`,`image`,`time`,`publish`,`ordering`) values (5,'Vilkår og handelsbetingelser','vilkar-og-handelsbetingelser',1,'<p>\r\n Vilk&aring;r og handelsbetingelser</p>\r\n','<h2>\r\n Handels &ndash; og medlemsbetingelser for Sugardating</h2>\r\n<div class=\"clear\">\r\n &nbsp;</div>\r\n<p>\r\n <b>Sugardating.COM</b> er en webportal, hvor du som bruger og medlem kan k&oslash;be og bortgive prim&aelig;rt voucher v&aelig;rdibeviser k&oslash;bt i Sugardating&rsquo;s webshop, SUGARSHOP.</p>\r\n<p>\r\n I SUGARSHOPPEN kan du finde tilbud p&aring; alt fra middag p&aring; en god restaurant til wellness fork&aelig;lelse og weekend rejser. Tilbuddene ser du som voucher v&aelig;rdibeviser, med varebeskrivelse, k&oslash;bsvilk&aring;r og pris i danske kroner, inklusiv 25 % moms.</p>\r\n<h5>\r\n SOM BRUGER OG MEDLEM AF Sugardating, SKAL DU ACCEPTERE NEDENST&Aring;ENDE HANDELS- OG MEDLEMSBETINGELSER:</h5>\r\n <h5 >\r\n HANDELSBETINGELSER</h5>\r\n<h6>\r\n 1. AFTALEINDG&Aring;ELSE</h6>\r\n<p>\r\n Disse standardbetingelser finder anvendelse ved k&oslash;b af voucher v&aelig;rdibevis fra webportalen Sugardating.COM samt ved &oslash;vrig brug af webportalen.</p>\r\n<h6>\r\n 2. VILK&Aring;R FOR BRUG AF Sugardating.COM</h6>\r\n<p>\r\n 2.1 Webportalen Sugardating.COM ejes af REDDOCKS MEDIA, CVR-nr. 27 36 46 08</p>\r\n<p>\r\n 2.2 Alle navne og varem&aelig;rker p&aring; webportalen Sugardating.COM tilh&oslash;rer REDDOCKS MEDIA eller dennes samarbejdspartnere og m&aring; kun anvendes med forudg&aring;ende tilladelse fra REDDOCKS MEDIA.</p>\r\n<p>\r\n 2.3 Information p&aring; Sugardating.COM gives uden nogen udtrykkelig eller stiltiende garanti for n&oslash;jagtigheden eller fuldst&aelig;ndigheden heraf. S&aring;fremt der linkes til en samarbejdspartners eller en tredjemands hjemmeside, sker dette uden ansvar for Sugardating og REDDOCKS MEDIA.</p>\r\n<p>\r\n 2.4 Sugardating.COM v/ REDDOCKS MEDIA kan i intet tilf&aelig;lde g&oslash;res erstatningsansvarlig for brug af samarbejdspartners eller en tredjemands hjemmeside.</p>\r\n<p>\r\n 2.5 Sugardating.COM v/ REDDOCKS MEDIA tager forbehold for eventuelle skrive- og/eller trykfejl p&aring; webportalen Sugardating.COM.</p>\r\n<h6>\r\n 3. K&Oslash;B AF VOUCHER V&AElig;RDIBEVIS</h6>\r\n<p>\r\n 3.1 P&aring; ovenn&aelig;vnte hjemmeside, Sugardating.COM, er der mulighed for at k&oslash;be voucher v&aelig;rdibeviser p&aring; varer og tjenesteydelser fra diverse samarbejdspartnere til fordelagtige priser. Det er vigtigt at v&aelig;re opm&aelig;rksom p&aring;, at levering af de varer/tjenesteydelser, som det k&oslash;bte voucher v&aelig;rdibevis giver adgang til, i enhver henseende alene leveres af samarbejdspartneren.</p>\r\n<p>\r\n 3.2 Det er en betingelse for k&oslash;b af voucher v&aelig;rdibeviser p&aring; Sugardating.COM, at kunden som minimum er 18 &aring;r eller derover.</p>\r\n<p>\r\n 3.3 Voucher v&aelig;rdibeviser bestilles online via webportalen Sugardating.COM.</p>\r\n<p>\r\n I forbindelse med bestilling af voucher v&aelig;rdibeviset, skal kunden angive navn, adresse, e-mailadresse, konto - og kortoplysninger med kortnummer, kortets udl&oslash;bsdato og kortets kontrolcifre.</p>\r\n<p>\r\n N&aring;r kundens bestilling er registreret hos Sugardating.COM og REDDOCKS MEDIA, fremsendes en ordrebekr&aelig;ftelse til kunden pr. e-mail. Den indeholder blandt andet et ordrenummer, navn og adresse p&aring; betaleren, betalingsmetode samt en oversigt over det k&oslash;bte. I tilf&aelig;lde af, at kunden ikke modtager en ordrebekr&aelig;ftelse, skal kunden kontakte Sugardating.COM. Ordrenummeret skal oplyses i forbindelse med al korrespondance med Sugardating. Der foreligger f&oslash;rst et retsm&aelig;ssigt salg af voucher v&aelig;rdibeviset, n&aring;r Sugardating har registreret kundens betaling.</p>\r\n<p>\r\n Umiddelbart efter at betalingen er registreret p&aring; Sugardating.COM og REDDOCKS MEDIA&rsquo;s konto og k&oslash;bet s&aring;ledes er gennemf&oslash;rt, vil et unikt link til voucher v&aelig;rdibeviset blive sendt pr. e-mail til kunden. Ved afsendelsen anvendes den e-mail adresse, som kunden har angivet under bestillingen.</p>\r\n<p>\r\n Er det ikke muligt for Sugardating.COM og REDDOCKS MEDIA at registrere kundens betaling &ndash; uanset af hvilken &aring;rsag, anses salget ikke for gennemf&oslash;rt og kunden har ikke krav p&aring; udlevering af voucher v&aelig;rdibevis.</p>\r\n<h6>\r\n 4. INDL&Oslash;SNING AF VOUCHER V&AElig;RDIBEVIS</h6>\r\n<p>\r\n 4.1 N&aring;r kunden har modtaget det unikke link til voucher v&aelig;rdibeviset, udskrives beviset, hvorefter kunden mod udlevering af voucher v&aelig;rdibeviset til den relevante samarbejdspartner, har mulighed for at f&aring; udleveret/udf&oslash;rt den p&aring;g&aelig;ldende vare/tjenesteydelse.</p>\r\n<p>\r\n I enkelte tilf&aelig;lde vil den vare, som voucher v&aelig;rdibeviset giver ret til, blive sendt direkte til kunden fra samarbejdspartneren. Kunden skal derfor have angivet sin korrekte adresse ved bestillingen. Hvis der er tale om et s&aring;dant tilf&aelig;lde vil dette v&aelig;re anf&oslash;rt p&aring; tilbuddet.</p>\r\n<p>\r\n 4.2 Gyldighedsperioden for voucher v&aelig;rdibeviset er angivet p&aring; beviset, og oplyses ligeledes p&aring; webportalen Sugardating.COM forud for bestilling. Fremg&aring;r gyldighedsperioden ikke af voucher v&aelig;rdibeviset, er dette gyldigt i 2 &aring;r fra udstedelsen. I det tilf&aelig;lde, hvor voucher v&aelig;rdibeviset vedr&oslash;rer en tidsbegr&aelig;nset vare/tjenesteydelse, herunder et arrangement eller lignende, vil voucher v&aelig;rdibevisets gyldighed dog automatisk v&aelig;re begr&aelig;nset hertil.</p>\r\n<p>\r\n 4.3 Det er ikke tilladt at kopiere eller manipulere med voucher v&aelig;rdibeviserne. Ved tilf&aelig;lde af mistanke om kopiering eller manipulering forbeholder Sugardating v/ REDDOCKS MEDIA sig ret til at videregive relevante oplysninger til den eller de respektive samarbejdspartnere.</p>\r\n<h6>\r\n 5. PRISER OG BETALING</h6>\r\n<p>\r\n 5.1 Alt salg sker til priser i danske kr. ligesom alle anf&oslash;rte priser er vejledende udsalgspriser inklusiv 25 % moms.</p>\r\n<h6>\r\n 5.2 BETALING</h6>\r\n<p>\r\n Ved k&oslash;b af voucher v&aelig;rdibeviser, er det muligt at benytte betaling med f&oslash;lgende kortbetalingstyper: Dankort, Visa, MasterCard, Maestro, Visa Electron, JCB og American Express. Der till&aelig;gges ikke gebyr ved kreditkortbetaling.</p>\r\n<p>\r\n Ved bestilling skal du indtaste dit kortnummer, kortets udl&oslash;bsdato og kortets kontrolcifre.</p>\r\n<h6>\r\n SIKKERHED</h6>\r\n<p>\r\n ePay, som vi benytter til betalingsgateway, bruger sikkerhedsprotokollen SSL, der krypterer information mellem en internet-browser (kortindehaveren) og en internet-server (forretningen). Det betyder, at de oplysninger, der overf&oslash;res ved betaling med betalingskort, beskyttes under overf&oslash;rslen fra computer videre til Sugardating og REDDOCKSMEDIA. Som krypteringsform ved elektronisk handel er SSL almindeligt udbredt og betragtes som en meget sikker l&oslash;sning.</p>\r\n<h6>\r\n 5.3 Der tages forbehold for trykfejl, kurs- og pris&aelig;ndringer samt tekniske fejl.</h6>\r\n<h6>\r\n 6. FORTRYDELSESRET</h6>\r\n<p>\r\n 6.1 Som forbruger har man 14 dages fuld fortrydelsesret, fra den dag linket til voucher v&aelig;rdibeviset modtages p&aring; e-mail. Fortrydelsesretten g&aelig;lder dog ikke ved k&oslash;b af voucher v&aelig;rdibeviser, der direkte eller indirekte giver adgang til diverse arrangementer og/eller events.</p>\r\n<p>\r\n 6.2 Fortrydelsesretten er endvidere betinget af, at voucher v&aelig;rdibeviset inden fristens udl&oslash;b sendes retur til Sugardating.COM via mail@Sugardating.com</p>\r\n<p>\r\n I begge tilf&aelig;lde skal f&oslash;lgende oplysninger vedsendes sammen med voucher v&aelig;rdibeviset: navn, e-mail adresse og telefon nr, samt registrerings- og kontonummer til overf&oslash;rsel af returbel&oslash;b. Hvis du har gemt ordrebekr&aelig;ftelsen, m&aring; du ogs&aring; gerne sende en kopi med af denne.</p>\r\n<p>\r\n De forsendelsesomkostninger, der p&aring;l&oslash;ber returnering af et voucher v&aelig;rdibevis, d&aelig;kkes af kunden.</p>\r\n<p>\r\n N&aring;r du har sendt et voucher bevis retur til Sugardating, krediterer vi det. Du f&aring;r krediteret voucher v&aelig;rdibevisets p&aring;lydende v&aelig;rdi. Bel&oslash;bet tilbagef&oslash;res til det angivne registrerings- og kontonummer eller det kreditkort, som er anvendt i forbindelse med k&oslash;b af voucher v&aelig;rdibeviset.</p>\r\n<p>\r\n 6.3 Fortrydelsesretten kan ikke g&oslash;res g&aelig;ldende efter indl&oslash;sning af voucher v&aelig;rdibeviset hos Sugardating&rsquo;s samarbejdspartnere.</p>\r\n<h6>\r\n 6.1 REKLAMATION</h6>\r\n<p>\r\n Der gives efter k&oslash;beloven en reklamationsret i 24 m&aring;neder p&aring; produktvarer. Det er dog en foruds&aelig;tning, at reklamationen ikke skyldes fejlagtig brug af produktvaren eller anden skadeforvoldende adf&aelig;rd, der har medf&oslash;rt manglen. Hvis produktvaren er beh&aelig;ftet med en mangel, er reklamationen berettiget. Reklamation indenfor 2 m&aring;neder, anses for v&aelig;rende rettidig.</p>\r\n<h6>\r\n 7. ANSVARSBEGR&AElig;NSNING</h6>\r\n<p>\r\n 7.1 Den p&aring;g&aelig;ldende vare/tjenesteydelse, som voucher v&aelig;rdibeviset giver adgang til, leveres af samarbejdspartneren i dennes navn og for dennes regning. Som f&oslash;lge heraf er Sugardating v/ REDDOCKS MEDIA ikke ansvarlig for eventuelle fejl og/eller mangler i forbindelse med samarbejdspartnerens indl&oslash;sning af voucher v&aelig;rdibeviset, med mindre andet f&oslash;lger af ufravigelig lovgivning. Sugardating v/ REDDOCKS MEDIA fraskriver sig derfor i videst muligt omfang ethvert ansvar for de varer/tjenesteydelser, som kunden modtager fra samarbejdspartnerne i forbindelse med indl&oslash;sning af voucher v&aelig;rdibeviset.</p>\r\n<p>\r\n Reklamationskrav vedr&oslash;rende varen/tjenesteydelsen eller indl&oslash;sningen heraf, skal rettes mod samarbejdspartneren. Relevant kontaktinfo vil altid v&aelig;re p&aring;f&oslash;rt og fremg&aring; tydeligt af p&aring;g&aelig;ldende voucher v&aelig;rdibevis.</p>\r\n<p>\r\n 7.2 Som f&oslash;lge af ovenn&aelig;vnte kan Sugardating v/ REDDOCKS MEDIA p&aring; ingen m&aring;de forpligtes til at udbetale nogen form for erstatning eller godtg&oslash;relse for eventuelle tab, som m&aring;tte forekomme i tilf&aelig;lde, hvor (1) voucher v&aelig;rdibeviset ikke indl&oslash;ses af samarbejdspartneren, (2) varen/tjenesteydelsen ikke svarer til kundens forventninger, (3) samarbejdspartneren er g&aring;et konkurs eller oph&oslash;rt med at eksistere, (4) eller &oslash;vrige forhold, som har indflydelse p&aring; den tjenesteydelse/vare, som voucher v&aelig;rdibeviset omhandler.</p>\r\n<p>\r\n 7.3 Sugardating tilstr&aelig;ber, at webportalen fungerer optimalt, men Sugardating kan ikke garantere, at webportal, telefon- og mailsystemer til enhver tid er fejlfrit og i drift. S&aring;fremt der opleves fejl- og driftsforstyrrelser, kan Sugardating altid kontaktes p&aring; telefon +45 31 22 91 99</p>\r\n<h6>\r\n 8. BEHANDLING AF PERSONOPLYSNINGER</h6>\r\n<p>\r\n 8.1 Ved k&oslash;b af voucher v&aelig;rdibevis p&aring; Sugardating.COM, registreres afgivne kundeoplysninger s&aring;som navn, adresse, telefonnummer og e-mail. Sugardating v/ REDDOCKS MEDIA er i den forbindelse ansvarlig for korrekt indsamling og h&aring;ndtering af data, if&oslash;lge g&aelig;ldende lovgivning.</p>\r\n<p>\r\n 8.2 Sugardating v/ REDDOCKS MEDIA forbeholder sig ret til at kontakte en kunde direkte via telefon eller e-mail, s&aring;fremt at der er behov for yderligere oplysning omkring et k&oslash;bt voucher v&aelig;rdibevis.</p>\r\n<h6>\r\n 9. &AElig;NDRING AF STANDARDBETINGELSER</h6>\r\n<p>\r\n 9.1 Sugardating v/ REDDOCKS MEDIA forbeholder sig ret til p&aring; et hvilket som helst tidspunkt at foretage &aelig;ndringer i n&aelig;rv&aelig;rende betingelser.</p>\r\n<p>\r\n De g&aelig;ldende betingelser vil til enhver tid fremg&aring; p&aring; WWW.Sugardating.COM.</p>\r\n<h6>\r\n 10. LOVVALG OG V&AElig;RNETING</h6>\r\n<p>\r\n 10.1 Tvistigheder i forbindelse med k&oslash;b via Sugardating skal afg&oslash;res efter dansk ret ved hjemtinget for REDDOCKS MEDIA, Retten i K&oslash;benhavn.</p>\r\n<div class=\"conditionItem\">\r\n  <h5 >\r\n  MEDLEMSBETINGELSER</h5>\r\n</div>\r\n<h6>\r\n 1. PERSONLIGT LOGIN OG MEDLEMSKAB</h6>\r\n<p>\r\n N&aring;r du tilmelder dig p&aring; Sugardating.COM, v&aelig;lger du mellem f&oslash;lgende medlemskaber:</p>\r\n<h6>\r\n 1.1 IKKE MEDLEM</h6>\r\n<p>\r\n Som ikke medlem kan du k&oslash;be og indl&oslash;se voucher v&aelig;rdibeviser i SUGARSHOPPEN.</p>\r\n<h6>\r\n 1.2 S&Oslash;LV MEDLEMSKAB</h6>\r\n<p>\r\n Som s&oslash;lvmedlem f&aring;r du en personlig profilside, hvortil der kun kan gives adgang med din e-mail og din personlige adgangskode. Adgangskoden er strengt personlig og m&aring; ikke overdrages til andre.</p>\r\n<p>\r\n P&aring; din personlige profilside&rsquo; kan du se og redigere dine personlige data. Du kan uploade dit eget profilfoto og skrive din egen profiltekst. Du f&aring;r desuden tildelt din egen unikke mail og mailboks hvor du kan modtage og sende post fra og til andre brugere og medlemmer af Sugardating, samt kommunikere med supportteamet bag Sugardating webportalen.</p>\r\n<p>\r\n P&aring; din profilside f&aring;r du endvidere din egen unikke SUGARBOX, som indeholder de voucher v&aelig;rdibeviser fra SUGARSHOPPEN, som du v&aelig;lger at k&oslash;be og selv g&oslash;re brug af.</p>\r\n<p>\r\n Et s&oslash;lvmedlemskab er gratis, og koster 0,00 dkr. pr. mdr. inkl. moms.</p>\r\n<h6>\r\n 1.3 GULD MEDLEMSKAB</h6>\r\n<p>\r\n Som guldmedlem f&aring;r du tildelt en personlig profilside, hvortil der kun kan gives adgang med din e-mail og din personlige adgangskode. Adgangskoden er strengt personlig og m&aring; ikke overdrages til andre.</p>\r\n<p>\r\n P&aring; din personlige profilside&rsquo; kan du se og redigere dine personlige data. Du kan uploade dit eget profilfoto p&aring; din profilside og desuden uploade fotos til dit eget Billedgalleri, samt skrive din egen profiltekst. Du f&aring;r din egen Blog side, og du kan skrive og besvare Dateopslag. Du f&aring;r dit eget Chat mig, hvor du kan chatte direkte 1-1 med andre medlemmer af Sugardating. Du f&aring;r desuden tildelt din egen unikke mail og mailboks hvor du kan modtage og sende post fra og til andre brugere og medlemmer af Sugardating, samt kommunikere med supportteamet bag Sugardating webportalen. P&aring; din profilside f&aring;r du endvidere din egen unikke &rdquo;SUGARBOX&rdquo;, som indeholder de voucher v&aelig;rdibeviser, du v&aelig;lger at k&oslash;be og selv g&oslash;re brug af. Du kan ogs&aring; v&aelig;lge at give voucher v&aelig;rdibeviserne til andre medlemmer i Sugardating ved at bruge &rdquo;SUGARBOX&rdquo; v&aelig;rkt&oslash;jerne eller maile til et af de andre Sugardating medlemmer. Desuden kan du modtage voucher v&aelig;rdibeviser fra andre brugere og medlemmer af Sugardating.</p>\r\n<p>\r\n Et guldmedlemskab koster 99, - dkr. pr. mdr. inkl. moms.</p>\r\n<h6>\r\n 1.4 MISBRUG OG LOVOVERTR&AElig;DELSER</h6>\r\n<p>\r\n Hvis du mod forventning f&aring;r mistanke om misbrug af din adgangskode, skal du omg&aring;ende rette henvendelse til Sugardating.COM, mail@Sugardating.com, s&aring; adgangen til din personlige side kan blive sp&aelig;rret. Til yderligere sikkerhed b&oslash;r du l&oslash;bende opdatere og informere Sugardating om eventuelle &aelig;ndringer af dine personlige data.</p>\r\n<p>\r\n Sugardating v/ REDDOCKS MEDIA forbeholder sig ret til at slette opslag og/eller brugerprofiler, der ikke overholder Sugardating&rsquo;s retningslinjer og g&aelig;ldende lovgivning. I s&aelig;rligt grove tilf&aelig;lde af overtr&aelig;delser vil der ske politianmeldelse.</p>\r\n<h6>\r\n 2. PERSONDATA</h6>\r\n<p>\r\n De personlige oplysninger, som du giver til Sugardating iforbindelse med profiloprettelse, behandles fortroligt og videregives ikke til tredjemand. Alle afgivne oplysninger er til enhver tid underlagt fortrolighed j&aelig;vnf&oslash;r g&aelig;ldende lovgivning. Du kan til en hver tid f&aring; lukket din profil p&aring; Sugardating.COM.</p>\r\n<h6>\r\n 3. RETNINGSLINIER FOR WEBPORTALEN</h6>\r\n<p>\r\n 3.1 Sugardating v/ REDDOCKS MEDIA er ikke ansvarlig for udtalelser, holdninger eller lignende fremsat p&aring; Sugardating.COM.</p>\r\n<p>\r\n Ordet er frit, men du skal holde en god tone. Indl&aelig;g, tekst og billeder, der har racistisk karakter, st&aelig;rkt injurierende udsagn, har et religi&oslash;st eller politisk budskab, h&oslash;rer ikke hjemme p&aring; Sugardating.COM webportalen. Du skal du respektere andre medlemmers mening, plads og leg p&aring; Sugardating. COM.</p>\r\n<p>\r\n I yderste konsekvens forbeholder Sugardating.COM. sig retten til at udmelde medlemmer som ikke overholder retningslinjerne for Sugardating.COM webportalen. I s&aring; fald vil eventuelt tilgodehavende hos Sugardating v/ REDDOCKS MEDIA ikke blive tilbagebetalt.</p>\r\n<p>\r\n 3.2 Sugardating.COM er ikke en markedsplads. Du m&aring; derfor ikke bruge Sugardating til at s&aelig;lge varer eller ydelser som ikke er k&oslash;bt og betalt i Sugardating&rsquo;s SUGARSHOP. Du m&aring; dog gerne henvise til dine k&oslash;b af voucher v&aelig;rdibeviser, varer eller ydelser k&oslash;bt i Sugardating&rsquo;s SUGARSHOP.</p>\r\n<h6>\r\n 4. FORBEHOLD</h6>\r\n<p>\r\n 4.1 Sugardating v/ REDDOCKS MEDIA kan ikke p&aring; noget tidspunkt g&oslash;res ansvarlig for manglende resultat ved Dateopslag, Chat mig, give eller modtage voucher v&aelig;rdibeviser samt ved misbrug af din adgangskode eller andre forhold i &oslash;vrigt.</p>\r\n<p>\r\n 4.2 I relation til force majeure er Sugardating v/ REDDOCKS MEDIA uden ansvar.</p>\r\n<p>\r\n 4.3 Sugardating v/ REDDOCKS MEDIA forbeholder sig ret til at placere annoncer efter bedste sk&oslash;n. Sugardating v/ REDDOCKS MEDIA forbeholder sig ret til at n&aelig;gte optagelse af annoncer, der strider imod lovgivningen, hensynet til brugere, medlemmer eller Sugardating v/ REDDOCKS MEDIA&rsquo;s interesser. Sugardating forbeholder sig ret til at slette profiler med manglende eller forkerte personoplysninger. Sugardating er uden ansvar for tab eller skade, der p&aring;f&oslash;res som f&oslash;lge af tastefejl, forst&aring;elsesfejl, forkert indrykningsdato eller manglende indrykning m.v.</p>\r\n<h6>\r\n 5. KONTAKT</h6>\r\n<p>\r\n Sugardating v/ REDDOCKS MEDIA<br />\r\n www.Sugardating.com<br />\r\n mail@Sugardating.com<br />\r\n Telefon +45 31 22 91 99<br />\r\n CVR-nr. 27 36 46 08</p>\r\n','a30a5a11bf7fd4844cdd50ecffdf6063.jpeg',1379479720,1,1),(6,'Sikkerhed','sikkerhed',1,'<p>\r\n Sikkerhed</p>\r\n','<h2>\r\n Sikkerhed</h2>\r\n<div class=\"clear\">\r\n &nbsp;</div>\r\n<h6>\r\n Our commitment to your personal information</h6>\r\n<p>\r\n Mauris accumsan tortor quis arcu bibendum dignissim. Nulla condimentum libero vitae sapien viverra aliquam. Nam magna magna, ultricies eget tincidunt id, viverra vehicula nisl. Fusce fringilla fringilla interdum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dictum tellus neque. Nam eu velit urna, id consectetur tortor. Nam in orci at turpis porttitor hendrerit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam orci leo, pharetra et lacinia non, condimentum ut purus. Suspendisse interdum, risus in porta mollis, eros mi bibendum erat, eu faucibus odio ante id neque. Sed tortor eros, suscipit sed pulvinar ac, luctus vulputate orci. Suspendisse aliquet convallis tempor.</p>\r\n<hr />\r\n<h6>\r\n Privacy policy</h6>\r\n<p>\r\n <b>Sugar Date Privacy Policy </b><br />\r\n Mauris accumsan tortor quis arcu bibendum dignissim. Nulla condimentum libero vitae sapien viverra aliquam. Nam magna magna, ultricies eget tincidunt id, viverra vehicula nisl. Fusce fringilla fringilla interdum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dictum tellus neque. Nam eu velit urna, id consectetur tortor. Nam in orci at turpis porttitor hendrerit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>\r\n<p>\r\n <b>Sugar Date Privacy Policy </b><br />\r\n Mauris accumsan tortor quis arcu bibendum dignissim. Nulla condimentum libero vitae sapien viverra aliquam. Nam magna magna, ultricies eget tincidunt id, viverra vehicula nisl. Fusce fringilla fringilla interdum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dictum tellus neque. Nam eu velit urna, id consectetur tortor. Nam in orci at turpis porttitor hendrerit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>\r\n<p>\r\n <b>Agreement</b><br />\r\n Mauris accumsan tortor quis arcu bibendum dignissim. Nulla condimentum libero vitae sapien viverra aliquam. Nam magna magna, ultricies eget tincidunt id, viverra vehicula nisl. Fusce fringilla fringilla interdum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dictum tellus neque. Nam eu velit urna, id consectetur tortor. Nam in orci at turpis porttitor hendrerit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>\r\n<p>\r\n <b>Age Limit</b><br />\r\n Mauris accumsan tortor quis arcu bibendum dignissim. Nulla condimentum libero vitae sapien viverra aliquam. Nam magna magna, ultricies eget tincidunt id, viverra vehicula nisl. Fusce fringilla fringilla interdum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dictum tellus neque. Nam eu velit urna, id consectetur tortor. Nam in orci at turpis porttitor hendrerit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>\r\n<p>\r\n <b>Usage </b><br />\r\n Mauris accumsan tortor quis arcu bibendum dignissim. Nulla condimentum libero vitae sapien viverra aliquam. Nam magna magna, ultricies eget tincidunt id, viverra vehicula nisl. Fusce fringilla fringilla interdum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dictum tellus neque. Nam eu velit urna, id consectetur tortor. Nam in orci at turpis porttitor hendrerit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>\r\n<p>\r\n <b>Account of the Member </b><br />\r\n Mauris accumsan tortor quis arcu bibendum dignissim. Nulla condimentum libero vitae sapien viverra aliquam. Nam magna magna, ultricies eget tincidunt id, viverra vehicula nisl. Fusce fringilla fringilla interdum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dictum tellus neque. Nam eu velit urna, id consectetur tortor. Nam in orci at turpis porttitor hendrerit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>\r\n<p>\r\n <b>Photos </b><br />\r\n Mauris accumsan tortor quis arcu bibendum dignissim. Nulla condimentum libero vitae sapien viverra aliquam. Nam magna magna, ultricies eget tincidunt id, viverra vehicula nisl. Fusce fringilla fringilla interdum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dictum tellus neque. Nam eu velit urna, id consectetur tortor. Nam in orci at turpis porttitor hendrerit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>\r\n<p>\r\n <b>Information Monitoring</b><br />\r\n Mauris accumsan tortor quis arcu bibendum dignissim. Nulla condimentum libero vitae sapien viverra aliquam. Nam magna magna, ultricies eget tincidunt id, viverra vehicula nisl. Fusce fringilla fringilla interdum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dictum tellus neque. Nam eu velit urna, id consectetur tortor. Nam in orci at turpis porttitor hendrerit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>\r\n<p>\r\n <b>Right to Cancellation </b><br />\r\n Mauris accumsan tortor quis arcu bibendum dignissim. Nulla condimentum libero vitae sapien viverra aliquam. Nam magna magna, ultricies eget tincidunt id, viverra vehicula nisl. Fusce fringilla fringilla interdum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dictum tellus neque. Nam eu velit urna, id consectetur tortor. Nam in orci at turpis porttitor hendrerit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>\r\n<p>\r\n <b>Losses </b><br />\r\n Mauris accumsan tortor quis arcu bibendum dignissim. Nulla condimentum libero vitae sapien viverra aliquam. Nam magna magna, ultricies eget tincidunt id, viverra vehicula nisl. Fusce fringilla fringilla interdum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dictum tellus neque. Nam eu velit urna, id consectetur tortor. Nam in orci at turpis porttitor hendrerit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>\r\n<p>\r\n <b>Use of your IP Address </b><br />\r\n Mauris accumsan tortor quis arcu bibendum dignissim. Nulla condimentum libero vitae sapien viverra aliquam. Nam magna magna, ultricies eget tincidunt id, viverra vehicula nisl. Fusce fringilla fringilla interdum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dictum tellus neque. Nam eu velit urna, id consectetur tortor. Nam in orci at turpis porttitor hendrerit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>\r\n<p>\r\n <b>Cookies </b><br />\r\n Mauris accumsan tortor quis arcu bibendum dignissim. Nulla condimentum libero vitae sapien viverra aliquam. Nam magna magna, ultricies eget tincidunt id, viverra vehicula nisl. Fusce fringilla fringilla interdum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dictum tellus neque. Nam eu velit urna, id consectetur tortor. Nam in orci at turpis porttitor hendrerit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>\r\n<p>\r\n <b>Information we hold about you and how we use it</b><br />\r\n Mauris accumsan tortor quis arcu bibendum dignissim. Nulla condimentum libero vitae sapien viverra aliquam. Nam magna magna, ultricies eget tincidunt id, viverra vehicula nisl. Fusce fringilla fringilla interdum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dictum tellus neque. Nam eu velit urna, id consectetur tortor. Nam in orci at turpis porttitor hendrerit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>\r\n<p>\r\n <b>Information in your personal profile </b><br />\r\n Mauris accumsan tortor quis arcu bibendum dignissim. Nulla condimentum libero vitae sapien viverra aliquam. Nam magna magna, ultricies eget tincidunt id, viverra vehicula nisl. Fusce fringilla fringilla interdum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dictum tellus neque. Nam eu velit urna, id consectetur tortor. Nam in orci at turpis porttitor hendrerit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>\r\n<p>\r\n <b>Special cases in which we share your information </b><br />\r\n Mauris accumsan tortor quis arcu bibendum dignissim. Nulla condimentum libero vitae sapien viverra aliquam. Nam magna magna, ultricies eget tincidunt id, viverra vehicula nisl. Fusce fringilla fringilla interdum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dictum tellus neque. Nam eu velit urna, id consectetur tortor. Nam in orci at turpis porttitor hendrerit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>\r\n<p>\r\n <b>Information other websites collect from you</b><br />\r\n Mauris accumsan tortor quis arcu bibendum dignissim. Nulla condimentum libero vitae sapien viverra aliquam. Nam magna magna, ultricies eget tincidunt id, viverra vehicula nisl. Fusce fringilla fringilla interdum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dictum tellus neque. Nam eu velit urna, id consectetur tortor. Nam in orci at turpis porttitor hendrerit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>\r\n<p>\r\n <b>Security Precautions </b><br />\r\n Mauris accumsan tortor quis arcu bibendum dignissim. Nulla condimentum libero vitae sapien viverra aliquam. Nam magna magna, ultricies eget tincidunt id, viverra vehicula nisl. Fusce fringilla fringilla interdum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dictum tellus neque. Nam eu velit urna, id consectetur tortor. Nam in orci at turpis porttitor hendrerit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>\r\n',NULL,1379663458,1,2),(7,'FAQ','faq',1,'<p>\r\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus lacinia laoreet iaculis. Mauris blandit suscipit venenatis. Nunc posuere nisi sed ante sollicitudin auctor.</p>\r\n','<p>\r\n Phasellus justo sapien, molestie vel posuere ac, interdum id est. Donec id quam metus. Sed gravida tortor ut dui pharetra iaculis. Duis et mollis leo. Ut lacinia urna vel tellus fringilla quis egestas elit sodales. Sed non mi quis lorem fermentum malesuada sit amet sit amet lorem. Suspendisse adipiscing placerat tellus, in euismod lectus accumsan blandit.</p>\r\n',NULL,1381135450,1,3),(8,'Fusce elementum molestie nisi, sit amet dictum mi malesuada sit amet?','fusce-elementum-molestie-nisi-sit-amet-dictum-mi-malesuada-sit-amet',2,'','<p>\r\n Phasellus justo sapien, molestie vel posuere ac, interdum id est. Donec id quam metus. Sed gravida tortor ut dui pharetra iaculis. Duis et mollis leo. Ut lacinia urna vel tellus fringilla quis egestas elit sodales. Sed non mi quis lorem fermentum malesuada sit amet sit amet lorem. Suspendisse adipiscing placerat tellus, in euismod lectus accumsan blandit.</p>\r\n',NULL,1381135526,1,4),(10,'FAQ Question 1','faq-question-1',2,'','<p>\r\n Phasellus justo sapien, molestie vel posuere ac, interdum id est. Donec id quam metus. Sed gravida tortor ut dui pharetra iaculis. Duis et mollis leo. Ut lacinia urna vel tellus fringilla quis egestas elit sodales. Sed non mi quis lorem fermentum malesuada sit amet sit amet lorem. Suspendisse adipiscing placerat tellus, in euismod lectus accumsan blandit.</p>\r\n',NULL,1381135576,1,6),(11,'Article 1','article-1',5,'<p>\r\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tempor tristique venenatis. Pellentesque suscipit tempor lectus quis vehicula.</p>\r\n','<div id=\"lipsum\">\r\n <p>\r\n  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tempor tristique venenatis. Pellentesque suscipit tempor lectus quis vehicula. Phasellus hendrerit libero quam, in porta purus ullamcorper eget. Pellentesque dignissim bibendum tortor, sit amet convallis quam laoreet vitae. Mauris vel mauris ac orci pellentesque adipiscing. Nam at hendrerit massa. Nullam eget tempus dolor, at malesuada orci. Nulla rutrum ante elit.</p>\r\n <p>\r\n  Cras sit amet felis eget sem vulputate accumsan. Ut sollicitudin arcu sit amet consequat vulputate. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean velit sapien, dictum sed feugiat quis, faucibus ac libero. Aliquam libero arcu, placerat a dui vestibulum, vulputate eleifend lectus. Duis cursus volutpat turpis eget consectetur. Phasellus consequat justo vel eros ultrices interdum.</p>\r\n <p>\r\n  Donec lectus magna, posuere lacinia enim a, consectetur accumsan odio. Integer consequat gravida tincidunt. Maecenas ut elit quis dolor varius iaculis et sit amet erat. Aliquam a elit massa. In ultricies imperdiet tellus, non posuere sem sollicitudin ullamcorper. Donec auctor ligula felis, vitae iaculis nisl vulputate at. Aenean ultricies leo ac tortor tristique facilisis. Praesent lobortis est nec justo sodales mattis. Donec mattis tellus sit amet magna accumsan vestibulum. Fusce hendrerit ac nunc sit amet mollis. Donec vitae porta lacus, id ultrices augue. In luctus egestas nisl non bibendum.</p>\r\n</div>\r\n<p>\r\n &nbsp;</p>\r\n',NULL,1384943448,1,0),(12,'Article 2','article-2',5,'<p>\r\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tempor tristique venenatis. Pellentesque suscipit tempor lectus quis vehicula.</p>\r\n','<div id=\"lipsum\">\r\n <p>\r\n  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tempor tristique venenatis. Pellentesque suscipit tempor lectus quis vehicula. Phasellus hendrerit libero quam, in porta purus ullamcorper eget. Pellentesque dignissim bibendum tortor, sit amet convallis quam laoreet vitae. Mauris vel mauris ac orci pellentesque adipiscing. Nam at hendrerit massa. Nullam eget tempus dolor, at malesuada orci. Nulla rutrum ante elit.</p>\r\n <p>\r\n  Cras sit amet felis eget sem vulputate accumsan. Ut sollicitudin arcu sit amet consequat vulputate. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean velit sapien, dictum sed feugiat quis, faucibus ac libero. Aliquam libero arcu, placerat a dui vestibulum, vulputate eleifend lectus. Duis cursus volutpat turpis eget consectetur. Phasellus consequat justo vel eros ultrices interdum.</p>\r\n <p>\r\n  Donec lectus magna, posuere lacinia enim a, consectetur accumsan odio. Integer consequat gravida tincidunt. Maecenas ut elit quis dolor varius iaculis et sit amet erat. Aliquam a elit massa. In ultricies imperdiet tellus, non posuere sem sollicitudin ullamcorper. Donec auctor ligula felis, vitae iaculis nisl vulputate at. Aenean ultricies leo ac tortor tristique facilisis. Praesent lobortis est nec justo sodales mattis. Donec mattis tellus sit amet magna accumsan vestibulum. Fusce hendrerit ac nunc sit amet mollis. Donec vitae porta lacus, id ultrices augue. In luctus egestas nisl non bibendum.</p>\r\n</div>\r\n<p>\r\n &nbsp;</p>\r\n',NULL,1384943471,1,0),(13,'Article 3','article-3',5,'<p>\r\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tempor tristique venenatis. Pellentesque suscipit tempor lectus quis vehicula. Phasellus hendrerit libero quam, in porta purus ullamcorper eget.</p>\r\n','<div id=\"lipsum\">\r\n <p>\r\n  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tempor tristique venenatis. Pellentesque suscipit tempor lectus quis vehicula. Phasellus hendrerit libero quam, in porta purus ullamcorper eget. Pellentesque dignissim bibendum tortor, sit amet convallis quam laoreet vitae. Mauris vel mauris ac orci pellentesque adipiscing. Nam at hendrerit massa. Nullam eget tempus dolor, at malesuada orci. Nulla rutrum ante elit.</p>\r\n <p>\r\n  Cras sit amet felis eget sem vulputate accumsan. Ut sollicitudin arcu sit amet consequat vulputate. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean velit sapien, dictum sed feugiat quis, faucibus ac libero. Aliquam libero arcu, placerat a dui vestibulum, vulputate eleifend lectus. Duis cursus volutpat turpis eget consectetur. Phasellus consequat justo vel eros ultrices interdum.</p>\r\n <p>\r\n  Donec lectus magna, posuere lacinia enim a, consectetur accumsan odio. Integer consequat gravida tincidunt. Maecenas ut elit quis dolor varius iaculis et sit amet erat. Aliquam a elit massa. In ultricies imperdiet tellus, non posuere sem sollicitudin ullamcorper. Donec auctor ligula felis, vitae iaculis nisl vulputate at. Aenean ultricies leo ac tortor tristique facilisis. Praesent lobortis est nec justo sodales mattis. Donec mattis tellus sit amet magna accumsan vestibulum. Fusce hendrerit ac nunc sit amet mollis. Donec vitae porta lacus, id ultrices augue. In luctus egestas nisl non bibendum.</p>\r\n</div>\r\n<p>\r\n &nbsp;</p>\r\n',NULL,1384943499,1,0),(14,'Del','del',6,'<p>\r\n Jo flere vi er herinde, jo sjovere er det at lege. &Aring;bn dit hjerte og</p>\r\n','',NULL,1385023214,1,0),(15,'Nu er du sugar medlem og kan lege med herinde !','nu-er-du-sugar-medlem-og-kan-lege-med-herinde',6,'<p>\r\n Velkommen! Es un hecho establecido hace demasiado tiempo que un lector se distraer&aacute; con el contenido del texto de un sitio mientras que mira su dise&ntilde;o.</p>\r\n','',NULL,1393983313,1,0),(16,'Brugerrettigheder for Sugardating Funktionalitet','brugerrettigheder-for-sugardating-funktionalitet',1,'','<table>\r\n <tbody>\r\n  <tr class=\"title\">\r\n   <td>\r\n    Funktionalitet</td>\r\n   <td>\r\n    Sølvmedlem<br />\r\n    (gratis)</td>\r\n   <td>\r\n    Guldmedlem<br />\r\n    (99, - pr. md)</td>\r\n  </tr>\r\n  <tr>\r\n   <td class=\"txt-left\">\r\n    Unik personlig log in og kode</td>\r\n   <td>\r\n    x</td>\r\n   <td>\r\n    x</td>\r\n  </tr>\r\n  <tr>\r\n   <td class=\"txt-left\">\r\n    Personlig profilside</td>\r\n   <td>\r\n    x</td>\r\n   <td>\r\n    x</td>\r\n  </tr>\r\n  <tr>\r\n   <td class=\"txt-left\">\r\n    Redigere profilside</td>\r\n   <td>\r\n    x</td>\r\n   <td>\r\n    x</td>\r\n  </tr>\r\n  <tr>\r\n   <td class=\"txt-left\">\r\n    Redigere personlige data</td>\r\n   <td>\r\n    x</td>\r\n   <td>\r\n    x</td>\r\n  </tr>\r\n  <tr>\r\n   <td class=\"txt-left\">\r\n    Tilføje motto under profilbillede</td>\r\n   <td>\r\n    x</td>\r\n   <td>\r\n    x</td>\r\n  </tr>\r\n  <tr>\r\n   <td class=\"txt-left\">\r\n    Upload profilbillede</td>\r\n   <td>\r\n    x</td>\r\n   <td>\r\n    x</td>\r\n  </tr>\r\n  <tr>\r\n   <td class=\"txt-left\">\r\n    Profilbillede synlig for medlemmer/ikke medlemmer</td>\r\n   <td>\r\n    x</td>\r\n   <td>\r\n    x</td>\r\n  </tr>\r\n  <tr>\r\n   <td class=\"txt-left\">\r\n    Unik personlig log in og kode</td>\r\n   <td>\r\n    x</td>\r\n   <td>\r\n    x</td>\r\n  </tr>\r\n  <tr>\r\n   <td class=\"txt-left\">\r\n    Upload fotos til Billedgalleri</td>\r\n   <td>\r\n     </td>\r\n   <td>\r\n    x</td>\r\n  </tr>\r\n  <tr>\r\n   <td class=\"txt-left\">\r\n    Billedgalleri synlig for medlemmer/ikke medlemmer</td>\r\n   <td>\r\n    x</td>\r\n   <td>\r\n    x</td>\r\n  </tr>\r\n  <tr>\r\n   <td class=\"txt-left\">\r\n    Profiltekst</td>\r\n   <td>\r\n    x</td>\r\n   <td>\r\n    x</td>\r\n  </tr>\r\n  <tr>\r\n   <td class=\"txt-left\">\r\n    Sugar Blog</td>\r\n   <td>\r\n     </td>\r\n   <td>\r\n    x</td>\r\n  </tr>\r\n  <tr>\r\n   <td class=\"txt-left\">\r\n    Sugar Blog posting på egen profil forside</td>\r\n   <td>\r\n     </td>\r\n   <td>\r\n    x</td>\r\n  </tr>\r\n  <tr>\r\n   <td class=\"txt-left\">\r\n    Sugar Blog posting på webportal forside</td>\r\n   <td>\r\n     </td>\r\n   <td>\r\n    x</td>\r\n  </tr>\r\n  <tr>\r\n   <td class=\"txt-left\">\r\n    Sugar Blog synlig for medlemmer/ikke medlemmer</td>\r\n   <td>\r\n     </td>\r\n   <td>\r\n    x</td>\r\n  </tr>\r\n  <tr>\r\n   <td class=\"txt-left\">\r\n    Sugar status posting på webportal forside</td>\r\n   <td>\r\n    x</td>\r\n   <td>\r\n    x</td>\r\n  </tr>\r\n  <tr>\r\n   <td class=\"txt-left\">\r\n    Sugar status søgning</td>\r\n   <td>\r\n    x</td>\r\n   <td>\r\n    x</td>\r\n  </tr>\r\n  <tr>\r\n   <td class=\"txt-left\">\r\n    Opslå Dateopslag</td>\r\n   <td>\r\n     </td>\r\n   <td>\r\n    x</td>\r\n  </tr>\r\n  <tr>\r\n   <td class=\"txt-left\">\r\n    Svare og skrive til Dateopslag</td>\r\n   <td>\r\n     </td>\r\n   <td>\r\n    x</td>\r\n  </tr>\r\n  <tr>\r\n   <td class=\"txt-left\">\r\n    Dateopslag kategori søgning</td>\r\n   <td>\r\n     </td>\r\n   <td>\r\n    x</td>\r\n  </tr>\r\n  <tr>\r\n   <td class=\"txt-left\">\r\n    Chat mig</td>\r\n   <td>\r\n     </td>\r\n   <td>\r\n    x</td>\r\n  </tr>\r\n  <tr>\r\n   <td class=\"txt-left\">\r\n    1-1 chat</td>\r\n   <td>\r\n     </td>\r\n   <td>\r\n    x</td>\r\n  </tr>\r\n  <tr>\r\n   <td class=\"txt-left\">\r\n    Modtage post</td>\r\n   <td>\r\n    x</td>\r\n   <td>\r\n    x</td>\r\n  </tr>\r\n  <tr>\r\n   <td class=\"txt-left\">\r\n    Sende post</td>\r\n   <td>\r\n    x</td>\r\n   <td>\r\n    x</td>\r\n  </tr>\r\n  <tr>\r\n   <td class=\"txt-left\">\r\n    Egen mailboks</td>\r\n   <td>\r\n    x</td>\r\n   <td>\r\n    x</td>\r\n  </tr>\r\n  <tr>\r\n   <td class=\"txt-left\">\r\n    Kontakt til Supportteam</td>\r\n   <td>\r\n    x</td>\r\n   <td>\r\n    x</td>\r\n  </tr>\r\n  <tr>\r\n   <td class=\"txt-left\">\r\n    Sugarbox</td>\r\n   <td>\r\n    x</td>\r\n   <td>\r\n    x</td>\r\n  </tr>\r\n  <tr>\r\n   <td class=\"txt-left\">\r\n    Se købte voucher værdibeviser</td>\r\n   <td>\r\n    x</td>\r\n   <td>\r\n    x</td>\r\n  </tr>\r\n  <tr>\r\n   <td class=\"txt-left\">\r\n    Se modtaget og givet voucher værdibeviser</td>\r\n   <td>\r\n     </td>\r\n   <td>\r\n    x</td>\r\n  </tr>\r\n  <tr>\r\n   <td class=\"txt-left\">\r\n    Se indløste voucher værdibeviser (mine deals)</td>\r\n   <td>\r\n    x</td>\r\n   <td>\r\n    x</td>\r\n  </tr>\r\n  <tr>\r\n   <td class=\"txt-left\">\r\n    Køb af voucher værdibeviser i Sugarshop</td>\r\n   <td>\r\n    x</td>\r\n   <td>\r\n    x</td>\r\n  </tr>\r\n  <tr>\r\n   <td class=\"txt-left\">\r\n    Indløse voucher værdibeviser</td>\r\n   <td>\r\n    x</td>\r\n   <td>\r\n    x</td>\r\n  </tr>\r\n  <tr>\r\n   <td class=\"txt-left\">\r\n    Give voucher værdibeviser</td>\r\n   <td>\r\n     </td>\r\n   <td>\r\n    x</td>\r\n  </tr>\r\n  <tr>\r\n   <td class=\"txt-left\">\r\n    Modtage voucher værdibeviser</td>\r\n   <td>\r\n     </td>\r\n   <td>\r\n    x</td>\r\n  </tr>\r\n  <tr>\r\n   <td class=\"txt-left\">\r\n    Venneliste</td>\r\n   <td>\r\n     </td>\r\n   <td>\r\n    x</td>\r\n  </tr>\r\n  <tr>\r\n   <td class=\"txt-left\">\r\n    Se når venneliste køber voucher værdibeviser</td>\r\n   <td>\r\n     </td>\r\n   <td>\r\n    x</td>\r\n  </tr>\r\n  <tr>\r\n   <td class=\"txt-left\">\r\n    Se hvad der sker</td>\r\n   <td>\r\n     </td>\r\n   <td>\r\n    x</td>\r\n  </tr>\r\n </tbody>\r\n</table>\r\n<h2>\r\n Brugerrettigheder for Sugardating Funktionalitet</h2>\r\n<div class=\"clear\">\r\n  </div>\r\n<h5>\r\n Sugardating har <span>3 forskellige typer medlemskaber</span> med hvert sit sæt af brugerrettigheder tilknyttet det enkelte medlemskab:</h5>\r\n<h6>\r\n 1. IKKE MEDLEM</h6>\r\n<p>\r\n Som ikke medlem kan du købe og indløse voucher værdibeviser i SUGARSHOPPEN.</p>\r\n<h6>\r\n 2. SØLV MEDLEMSKAB</h6>\r\n<p>\r\n Som sølvmedlem får du en personlig profilside, hvortil der kun kan gives adgang med din e-mail og din personlige adgangskode. Adgangskoden er strengt personlig og må ikke overdrages til andre.</p>\r\n<p>\r\n På din personlige profilside’ kan du se og redigere dine personlige data. Du kan uploade dit eget profilfoto og skrive din egen profiltekst. Du får desuden tildelt din egen unikke mail og mailboks hvor du kan modtage og sende post fra og til andre brugere og medlemmer af Sugardating, samt kommunikere med supportteamet bag Sugardating webportalen.</p>\r\n<p>\r\n På din profilside får du endvidere din egen unikke SUGARBOX, som indeholder de voucher værdibeviser fra SUGARSHOPPEN, som du vælger at købe og selv gøre brug af.</p>\r\n<p>\r\n Et sølvmedlemskab er gratis, og koster 0,00 dkr. pr. mdr. inkl. moms.</p>\r\n<h6>\r\n 3. GULD MEDLEMSKAB</h6>\r\n<p>\r\n Som guldmedlem får du tildelt en personlig profilside, hvortil der kun kan gives adgang med din e-mail og din personlige adgangskode. Adgangskoden er strengt personlig og må ikke overdrages til andre.</p>\r\n<p>\r\n På din personlige profilside’ kan du se og redigere dine personlige data. Du kan uploade dit eget profilfoto på din profilside og desuden uploade fotos til dit eget Billedgalleri, samt skrive din egen profiltekst. Du får din egen Blog side, og du kan skrive og besvare Dateopslag. Du får dit eget Chat mig, hvor du kan chatte direkte 1-1 med andre medlemmer af Sugardating. Du får desuden tildelt din egen unikke mail og mailboks hvor du kan modtage og sende post fra og til andre brugere og medlemmer af Sugardating, samt kommunikere med supportteamet bag Sugardating webportalen. På din profilside får du endvidere din egen unikke ”SUGARBOX”, som indeholder de voucher værdibeviser, du vælger at købe og selv gøre brug af. Du kan også vælge at give voucher værdibeviserne til andre medlemmer i Sugardating ved at bruge ”SUGARBOX” værktøjerne eller maile til et af de andre Sugardating medlemmer. Desuden kan du modtage voucher værdibeviser fra andre brugere og medlemmer af Sugardating.</p>\r\n<p>\r\n Et guldmedlemskab koster 99, - dkr. pr. mdr. inkl. moms.</p>\r\n',NULL,1393986372,1,0),(18,'test slideshow','test-slideshow',7,'<p>\r\n test slideshow</p>\r\n','<p>\r\n test slideshowtest slideshowtest slideshowtest slideshowtest slideshowtest slideshowtest slideshowtest slideshowtest slideshowtest slideshowtest slideshowtest slideshowtest slideshow</p>\r\n',NULL,1394593732,1,0),(19,'Help dating 1','help-dating-1',1,'<p>\r\n Find og VIP invitér den sugardate, som du synes er helt speciel! Skriv derefter en god overskrift i feltet \'Opret Dateopslag\'. Har du allerede købt voucher til daten, så find og vis den i \'Kategori\' feltet. Vælg hvornår dit dateforslag udløber, og beskriv kort hvad I skal lave sammen på daten. Tryk på \'Opret\' og send din VIP invitation til den udvalgte! Det bliver sjovt! God fornøjelse!</p>\r\n','',NULL,1401762899,1,0),(20,'Help dating 2','help-dating-2',1,'<p>\r\n Har du en idé til en date, men mangler en at invitere ud?<br />\r\n Så spring VIP invitation over og opret direkte et Dateopslag med en god overskrift. Har du allerede købt voucher til daten, så find og vis den i \'Kategori\' feltet. Vælg hvornår din date udløber, og beskriv kort hvad I skal lave sammen. Tryk på \'Opret\' og vis dit Dateopslag til alle herinde. Se hvem der vil med! Se hvad der sker! God fornøjelse!</p>\r\n','',NULL,1401762938,1,0),(21,'Cookie','cookie',1,'<p>\r\n Denne hjemmeside bruger cookies. Cookies er n&oslash;dvendige for at f&aring; hjemmesiden til at fungere, men de giver ogs&aring; info om<br />\r\n hvordan du bruger vores hjemmeside, s&aring; vi kan forbedre den b&aring;de for dig og for andre.<br />\r\n Cookies p&aring; denne hjemmeside bruges prim&aelig;rt til trafikm&aring;ling og optimering af sidens indhold. Hvis du klikker videre p&aring; siden, accepterer du vores brug af cookies.</p>\r\n','',NULL,1402992992,1,0);

/*Table structure for table `b2b_user` */

DROP TABLE IF EXISTS `b2b_user`;

CREATE TABLE `b2b_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `web` varchar(255) DEFAULT NULL,
  `last_login` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `publish` tinyint(4) DEFAULT NULL,
  `ordering` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1005 DEFAULT CHARSET=utf8;

/*Data for the table `b2b_user` */

insert  into `b2b_user`(`id`,`email`,`password`,`name`,`company`,`image`,`web`,`last_login`,`time`,`publish`,`ordering`) values (1002,'kim@graphit.dk','e10adc3949ba59abbe56e057f20f883e','Administrator','MWC','',NULL,1395739424,1377071942,1,0),(1003,'cuong@yahoo.com','1bbd886460827015e5d605ed44252251','Le Cuong','Cuong Dola',NULL,NULL,1410431484,1394614702,1,NULL);

/*Table structure for table `banner` */

DROP TABLE IF EXISTS `banner`;

CREATE TABLE `banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `alias` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `link_path` varchar(255) NOT NULL,
  `publish` tinyint(4) NOT NULL,
  `ordering` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `banner` */

insert  into `banner`(`id`,`title`,`alias`,`image`,`link_path`,`publish`,`ordering`) values (3,'Banner 1','banner-1','1e9519602f0d0036459d6be36b8cbeb3.jpeg','http://mywebcreations.dk',1,2),(4,'Banner 2','banner-2','f52b7548d1819c6b8f47c8ece855df94.jpeg','http://mywebcreations.dk',1,1),(5,'Banner 3','banner-3','07282fd501a9b9b72ad8308b54ac80f6.jpeg','http://google.com',1,3),(6,'Banner 4','banner-4','97630a1122e9426c81d5be7870ab89ac.jpeg','http://google.com',1,4);

/*Table structure for table `blog` */

DROP TABLE IF EXISTS `blog`;

CREATE TABLE `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `alias` text NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `time` int(11) NOT NULL,
  `publish` tinyint(4) NOT NULL,
  `ordering` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*Data for the table `blog` */

insert  into `blog`(`id`,`user_id`,`title`,`alias`,`content`,`image`,`time`,`publish`,`ordering`) values (6,1015,'title 111111111','title-111111111','<p>\r\n	1111111111Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. Sed dignissim lacinia nunc.<br />\r\n	<br />\r\n	Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa. Fusce ac turpis quis ligula lacinia aliquet. Mauris ipsum. Nulla metus metus, ullamcorper vel, tincidunt sed, euismod in, nibh.<br />\r\n	<br />\r\n	Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante. Sed lacinia, urna non tincidunt mattis, tortor neque adipiscing diam, a cursus ipsum ante quis turpis. Nulla facilisi. Ut fringilla. Suspendisse potenti. Nunc feugiat mi a tellus consequat imperdiet. Vestibulum sapien. Proin quam. Etiam ultrices.<br />\r\n	<br />\r\n	Suspendisse in justo eu magna luctus suscipit. Sed lectus. Integer euismod lacus luctus magna. Quisque cursus, metus vitae pharetra auctor, sem massa mattis sem, at interdum magna augue eget diam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Morbi lacinia molestie dui. Praesent blandit dolor. Sed non quam. In vel mi sit amet augue congue elementum. Morbi in ipsum sit amet pede facilisis laoreet. Donec lacus nunc, viverra nec, blandit vel, egestas et, augue. Vestibulum tincidunt malesuada tellus. Ut ultrices ultrices enim. Curabitur sit amet mauris.<br />\r\n	<br />\r\n	Morbi in dui quis est pulvinar ullamcorper. Nulla facilisi. Integer lacinia sollicitudin massa. Cras metus. Sed aliquet risus a tortor. Integer id quam. Morbi mi. Quisque nisl felis, venenatis tristique, dignissim in, ultrices sit amet, augue. Proin sodales libero eget ante. Nulla quam. Aenean laoreet. Vestibulum nisi lectus, commodo ac, facilisis ac, ultricies eu, pede.<br />\r\n	<br />\r\n	&nbsp;</p>\r\n','b368b75e37b0b51fe277c943596db0a5.jpeg',1378887064,1,0),(9,1015,'title 2','title-2','<p>\r\n	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. Sed dignissim lacinia nunc.<br />\r\n	<br />\r\n	Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa. Fusce ac turpis quis ligula lacinia aliquet. Mauris ipsum. Nulla metus metus, ullamcorper vel, tincidunt sed, euismod in, nibh.<br />\r\n	<br />\r\n	Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante. Sed lacinia, urna non tincidunt mattis, tortor neque adipiscing diam, a cursus ipsum ante quis turpis. Nulla facilisi. Ut fringilla. Suspendisse potenti. Nunc feugiat mi a tellus consequat imperdiet. Vestibulum sapien. Proin quam. Etiam ultrices.<br />\r\n	<br />\r\n	Suspendisse in justo eu magna luctus suscipit. Sed lectus. Integer euismod lacus luctus magna. Quisque cursus, metus vitae pharetra auctor, sem massa mattis sem, at interdum magna augue eget diam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Morbi lacinia molestie dui. Praesent blandit dolor. Sed non quam. In vel mi sit amet augue congue elementum. Morbi in ipsum sit amet pede facilisis laoreet. Donec lacus nunc, viverra nec, blandit vel, egestas et, augue. Vestibulum tincidunt malesuada tellus. Ut ultrices ultrices enim. Curabitur sit amet mauris.<br />\r\n	<br />\r\n	Morbi in dui quis est pulvinar ullamcorper. Nulla facilisi. Integer lacinia sollicitudin massa. Cras metus. Sed aliquet risus a tortor. Integer id quam. Morbi mi. Quisque nisl felis, venenatis tristique, dignissim in, ultrices sit amet, augue. Proin sodales libero eget ante. Nulla quam. Aenean laoreet. Vestibulum nisi lectus, commodo ac, facilisis ac, ultricies eu, pede.</p>\r\n','2c72de399ed7a98ebee29effb9b80eac.jpg',1382515053,1,0),(8,1014,'title 1','title-1','<p>\r\n	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. Sed dignissim lacinia nunc.<br />\r\n	<br />\r\n	Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa. Fusce ac turpis quis ligula lacinia aliquet. Mauris ipsum. Nulla metus metus, ullamcorper vel, tincidunt sed, euismod in, nibh.<br />\r\n	<br />\r\n	Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante. Sed lacinia, urna non tincidunt mattis, tortor neque adipiscing diam, a cursus ipsum ante quis turpis. Nulla facilisi. Ut fringilla. Suspendisse potenti. Nunc feugiat mi a tellus consequat imperdiet. Vestibulum sapien. Proin quam. Etiam ultrices.<br />\r\n	<br />\r\n	Suspendisse in justo eu magna luctus suscipit. Sed lectus. Integer euismod lacus luctus magna. Quisque cursus, metus vitae pharetra auctor, sem massa mattis sem, at interdum magna augue eget diam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Morbi lacinia molestie dui. Praesent blandit dolor. Sed non quam. In vel mi sit amet augue congue elementum. Morbi in ipsum sit amet pede facilisis laoreet. Donec lacus nunc, viverra nec, blandit vel, egestas et, augue. Vestibulum tincidunt malesuada tellus. Ut ultrices ultrices enim. Curabitur sit amet mauris.<br />\r\n	<br />\r\n	Morbi in dui quis est pulvinar ullamcorper. Nulla facilisi. Integer lacinia sollicitudin massa. Cras metus. Sed aliquet risus a tortor. Integer id quam. Morbi mi. Quisque nisl felis, venenatis tristique, dignissim in, ultrices sit amet, augue. Proin sodales libero eget ante. Nulla quam. Aenean laoreet. Vestibulum nisi lectus, commodo ac, facilisis ac, ultricies eu, pede.</p>\r\n','d4544f5e3d52c8c850589ae6078b819a.jpg',1382497200,1,0),(11,1015,'ccccccccccc','ccccccccccc','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. Sed dignissim lacinia nunc.</p>\r\n','29d3eec9474e49135db9703e18ab438c.jpg',1384159586,1,0),(12,1014,'test blog 2','test-blog-2',' <p>\n  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam condimentum ultricies consectetur. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce feugiat scelerisque velit in consequat. Quisque commodo nisi lorem, ut ultrices justo interdum ac. Quisque cursus pulvinar urna, sit amet ornare lorem lacinia ac. Curabitur placerat tempor ornare. Aenean at diam in ipsum aliquet feugiat. Duis egestas nulla purus. Suspendisse eros libero, lacinia faucibus accumsan sit amet, consectetur at magna. Etiam at orci id mi gravida lobortis. Aliquam nec imperdiet elit. Nulla facilisi.</p>\n <p>\n  Etiam pharetra ultrices vestibulum. Nulla elementum, nunc eget lobortis euismod, velit sem interdum erat, imperdiet viverra leo est nec arcu. Maecenas elementum viverra aliquam. Nulla facilisi. Morbi at pretium dui. In at dui dignissim, blandit eros a, iaculis augue. Quisque dictum tempor magna sit amet sodales. Nulla at bibendum mauris. Mauris a augue mollis, dictum augue accumsan, iaculis purus. Aenean velit nisl, semper vitae nunc a, cursus adipiscing risus. Sed feugiat rhoncus ligula in ullamcorper. Ut eleifend interdum ultrices. Quisque pellentesque, urna nec semper tempus, lorem erat pellentesque est, non venenatis purus lectus id ligula.</p>\n <p>\n  Proin sagittis, ante vitae tincidunt auctor, massa odio vulputate sapien, sed tempor leo magna nec felis. Nam augue felis, molestie eget placerat consectetur, adipiscing non turpis. Ut bibendum molestie orci. Praesent vitae lorem in sapien tempus auctor. Aenean ut purus tortor. Fusce sodales quis erat in sollicitudin. Sed molestie massa et consequat adipiscing. Suspendisse faucibus nibh vitae porta fringilla. Maecenas magna nisi, rhoncus ac orci at, molestie fermentum quam. Donec suscipit urna tellus. Pellentesque sagittis, augue sed tempus tincidunt, diam elit fringilla augue, id iaculis est purus non lorem. Sed id mi quis sapien commodo volutpat nec et leo. Vivamus purus enim, pretium sed iaculis ut, volutpat vitae risus. Quisque eget semper orci. Pellentesque tempor aliquet risus non fermentum. Pellentesque quis purus faucibus, varius mi ac, vestibulum nulla.</p>\n <p>\n  Morbi in est porttitor, convallis nulla et, mattis velit. Morbi suscipit, urna non ultrices placerat, est erat facilisis lectus, quis ultricies sapien sapien at sapien. Nullam eu lacus eget libero feugiat mattis sed id urna. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris quis accumsan lacus, sed consectetur lorem. Mauris eleifend semper lorem, sit amet vulputate mi lacinia sit amet. Ut ac justo mi. Sed ac tempor nulla. Phasellus nunc nunc, viverra non hendrerit sit amet, convallis sit amet purus. Fusce adipiscing magna a viverra tempus. Nullam eget diam nibh. Curabitur eu erat sed urna hendrerit vehicula egestas in dolor. Fusce scelerisque ante diam, sit amet viverra arcu hendrerit ut. In hac habitasse platea dictumst.</p>\n <p>\n  Nullam at quam sed arcu pulvinar feugiat vel sit amet quam. Vivamus faucibus accumsan viverra. Etiam id diam venenatis, convallis lectus vitae, ullamcorper ipsum. Ut quis mi interdum, dapibus neque vitae, molestie enim. Sed eu vehicula orci. Morbi elit mauris, volutpat quis nunc vitae, ullamcorper iaculis ante. Aenean hendrerit massa eget velit tempor, et vehicula sem consequat. Sed gravida, elit ac lacinia vestibulum, nisi ipsum interdum purus, et venenatis purus lorem in purus. Ut vestibulum arcu non viverra porttitor. Ut euismod sapien quis scelerisque dictum. Cras sollicitudin enim arcu, eget adipiscing metus lobortis ac. Sed metus justo, condimentum quis venenatis sed, convallis at nibh. Vivamus quis elit non elit ullamcorper ultricies. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Curabitur at porta felis.</p>\n','69098a7d81477fa5644b01d53cf21184.jpg',1384918588,1,0),(14,1014,'test 1111','test-1111','<p>\r\n asd asd asd</p>\r\n',NULL,1386145560,1,0),(13,1014,'test blog 3','test-blog-3','<p>\r\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. Sed dignissim lacinia nunc.<br />\r\n <br />\r\n Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa. Fusce ac turpis quis ligula lacinia aliquet. Mauris ipsum. Nulla metus metus, ullamcorper vel, tincidunt sed, euismod in, nibh.<br />\r\n <br />\r\n Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante. Sed lacinia, urna non tincidunt mattis, tortor neque adipiscing diam, a cursus ipsum ante quis turpis. Nulla facilisi. Ut fringilla. Suspendisse potenti. Nunc feugiat mi a tellus consequat imperdiet. Vestibulum sapien. Proin quam. Etiam ultrices.<br />\r\n <br />\r\n Suspendisse in justo eu magna luctus suscipit. Sed lectus. Integer euismod lacus luctus magna. Quisque cursus, metus vitae pharetra auctor, sem massa mattis sem, at interdum magna augue eget diam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Morbi lacinia molestie dui. Praesent blandit dolor. Sed non quam. In vel mi sit amet augue congue elementum. Morbi in ipsum sit amet pede facilisis laoreet. Donec lacus nunc, viverra nec, blandit vel, egestas et, augue. Vestibulum tincidunt malesuada tellus. Ut ultrices ultrices enim. Curabitur sit amet mauris.<br />\r\n <br />\r\n Morbi in dui quis est pulvinar ullamcorper. Nulla facilisi. Integer lacinia sollicitudin massa. Cras metus. Sed aliquet risus a tortor. Integer id quam. Morbi mi. Quisque nisl felis, venenatis tristique, dignissim in, ultrices sit amet, augue. Proin sodales libero eget ante. Nulla quam. Aenean laoreet. Vestibulum nisi lectus, commodo ac, facilisis ac, ultricies eu, pede.</p>\r\n',NULL,1385608975,1,0),(22,1017,'Check blog','check-blog','<p>\r\n	Check blog ABC.</p>\r\n','71a4b21f5572d404bc8980406e63f057.jpg',1412567701,1,0),(21,1023,'Test blog','test-blog','<p>\r\n	asdasdasdas d asd</p>\r\n',NULL,1409735519,1,0);

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `publish` tinyint(4) NOT NULL,
  `ordering` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `category` */

insert  into `category`(`id`,`name`,`alias`,`time`,`publish`,`ordering`) values (1,'Pages','pages',1377665317,1,0),(2,'FAQ','faq',1377677967,1,0),(4,'Category 3','category-3',1377678319,1,0),(5,'Articles','articles',1384943357,1,0),(6,'Other','other',1385023187,1,0),(7,'Slideshow','slideshow',1394533268,1,0);

/*Table structure for table `cometchat` */

DROP TABLE IF EXISTS `cometchat`;

CREATE TABLE `cometchat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from` int(10) unsigned NOT NULL,
  `to` int(10) unsigned NOT NULL,
  `message` text NOT NULL,
  `sent` int(10) unsigned NOT NULL DEFAULT '0',
  `read` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `direction` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `to` (`to`),
  KEY `from` (`from`),
  KEY `direction` (`direction`),
  KEY `read` (`read`),
  KEY `sent` (`sent`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `cometchat` */

insert  into `cometchat`(`id`,`from`,`to`,`message`,`sent`,`read`,`direction`) values (1,1014,1015,'asdasd',1382696034,1,0),(2,1015,1014,'acacac',1382696044,1,0),(3,1014,1015,'<img class=\"cometchat_smiley\" height=\"16\" width=\"16\" src=\"/sugardating/cometchat/images/smileys/nerd.png\" title=\"Nerd\">',1382696117,1,0),(4,1014,1015,'aaa',1394003014,1,0),(5,1014,1015,'bbbb',1394003033,1,0),(6,1015,1014,'qeqwe',1394003189,1,0),(7,1014,1015,'qweq we qwe qwe',1394004958,1,0),(8,1015,1014,'545465',1394005030,1,0);

/*Table structure for table `cometchat_announcements` */

DROP TABLE IF EXISTS `cometchat_announcements`;

CREATE TABLE `cometchat_announcements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `announcement` text NOT NULL,
  `time` int(10) unsigned NOT NULL,
  `to` int(10) NOT NULL,
  `recd` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `to` (`to`),
  KEY `time` (`time`),
  KEY `to_id` (`to`,`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cometchat_announcements` */

/*Table structure for table `cometchat_block` */

DROP TABLE IF EXISTS `cometchat_block`;

CREATE TABLE `cometchat_block` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fromid` int(10) unsigned NOT NULL,
  `toid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fromid` (`fromid`),
  KEY `toid` (`toid`),
  KEY `fromid_toid` (`fromid`,`toid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cometchat_block` */

/*Table structure for table `cometchat_chatroommessages` */

DROP TABLE IF EXISTS `cometchat_chatroommessages`;

CREATE TABLE `cometchat_chatroommessages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned NOT NULL,
  `chatroomid` int(10) unsigned NOT NULL,
  `message` text NOT NULL,
  `sent` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `chatroomid` (`chatroomid`),
  KEY `sent` (`sent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cometchat_chatroommessages` */

/*Table structure for table `cometchat_chatrooms` */

DROP TABLE IF EXISTS `cometchat_chatrooms`;

CREATE TABLE `cometchat_chatrooms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `lastactivity` int(10) unsigned NOT NULL,
  `createdby` int(10) unsigned NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL,
  `vidsession` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lastactivity` (`lastactivity`),
  KEY `createdby` (`createdby`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cometchat_chatrooms` */

/*Table structure for table `cometchat_chatrooms_users` */

DROP TABLE IF EXISTS `cometchat_chatrooms_users`;

CREATE TABLE `cometchat_chatrooms_users` (
  `userid` int(10) unsigned NOT NULL,
  `chatroomid` int(10) unsigned NOT NULL,
  `lastactivity` int(10) unsigned NOT NULL,
  `isbanned` int(1) DEFAULT '0',
  PRIMARY KEY (`userid`,`chatroomid`) USING BTREE,
  KEY `chatroomid` (`chatroomid`),
  KEY `lastactivity` (`lastactivity`),
  KEY `userid` (`userid`),
  KEY `userid_chatroomid` (`chatroomid`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cometchat_chatrooms_users` */

/*Table structure for table `cometchat_comethistory` */

DROP TABLE IF EXISTS `cometchat_comethistory`;

CREATE TABLE `cometchat_comethistory` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `channel` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `sent` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `channel` (`channel`),
  KEY `sent` (`sent`),
  KEY `channel_sent` (`channel`,`sent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cometchat_comethistory` */

/*Table structure for table `cometchat_games` */

DROP TABLE IF EXISTS `cometchat_games`;

CREATE TABLE `cometchat_games` (
  `userid` int(10) unsigned NOT NULL,
  `score` int(10) unsigned DEFAULT NULL,
  `games` int(10) unsigned DEFAULT NULL,
  `recentlist` text,
  `highscorelist` text,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cometchat_games` */

/*Table structure for table `cometchat_guests` */

DROP TABLE IF EXISTS `cometchat_guests`;

CREATE TABLE `cometchat_guests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `lastactivity` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lastactivity` (`lastactivity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cometchat_guests` */

/*Table structure for table `cometchat_messages_old` */

DROP TABLE IF EXISTS `cometchat_messages_old`;

CREATE TABLE `cometchat_messages_old` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from` int(10) unsigned NOT NULL,
  `to` int(10) unsigned NOT NULL,
  `message` text NOT NULL,
  `sent` int(10) unsigned NOT NULL DEFAULT '0',
  `read` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `direction` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `to` (`to`),
  KEY `from` (`from`),
  KEY `direction` (`direction`),
  KEY `read` (`read`),
  KEY `sent` (`sent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cometchat_messages_old` */

/*Table structure for table `cometchat_status` */

DROP TABLE IF EXISTS `cometchat_status`;

CREATE TABLE `cometchat_status` (
  `userid` int(10) unsigned NOT NULL,
  `message` text,
  `status` enum('available','away','busy','invisible','offline') DEFAULT NULL,
  `typingto` int(10) unsigned DEFAULT NULL,
  `typingtime` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`userid`),
  KEY `typingto` (`typingto`),
  KEY `typingtime` (`typingtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cometchat_status` */

insert  into `cometchat_status`(`userid`,`message`,`status`,`typingto`,`typingtime`) values (1014,NULL,'available',NULL,NULL),(1015,NULL,'available',NULL,NULL),(1017,NULL,'available',NULL,NULL),(1022,NULL,'away',NULL,NULL);

/*Table structure for table `cometchat_videochatsessions` */

DROP TABLE IF EXISTS `cometchat_videochatsessions`;

CREATE TABLE `cometchat_videochatsessions` (
  `username` varchar(255) NOT NULL,
  `identity` varchar(255) NOT NULL,
  `timestamp` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`username`),
  KEY `username` (`username`),
  KEY `identity` (`identity`),
  KEY `timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cometchat_videochatsessions` */

/*Table structure for table `config` */

DROP TABLE IF EXISTS `config`;

CREATE TABLE `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `config` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `config` */

insert  into `config`(`id`,`name`,`config`,`value`) values (3,'Item on a page','item_per_page','20'),(4,'Upload avatar path','upload_avatar_path','./upload/user/'),(5,'Max size','max_size','0'),(6,'Upload_gallery_path','upload_gallery_path','./upload/gallery/'),(7,'Upload image path','upload_image_path','./upload/images/'),(8,'Upload deal category path','upload_deal_category_path','./upload/deal_category/'),(9,'Upload news path','upload_news_path','./upload/news/'),(10,'Upload blog path','upload_blog_path','./upload/blog/'),(11,'Upload banner path','upload_banner_path','./upload/banner/'),(12,'Upload b2b path','upload_b2b_path','./upload/b2b/'),(13,'Upload deal path','upload_deal_path','./upload/deal/'),(14,'Gold member fee','gold_member_fee','99'),(15,'Upload slideshow path','upload_slideshow_path','./upload/slideshow/'),(16,'Enable slideshow','enable_slideshow','1');

/*Table structure for table `dating` */

DROP TABLE IF EXISTS `dating`;

CREATE TABLE `dating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `accepted_user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `order_item_id` int(11) NOT NULL,
  `end_date` int(11) NOT NULL,
  `description` text NOT NULL,
  `time` int(11) NOT NULL,
  `publish` tinyint(4) NOT NULL,
  `uservip` int(11) DEFAULT NULL,
  `timevip` int(11) DEFAULT '0',
  `used` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

/*Data for the table `dating` */

insert  into `dating`(`id`,`user_id`,`accepted_user_id`,`title`,`alias`,`order_item_id`,`end_date`,`description`,`time`,`publish`,`uservip`,`timevip`,`used`) values (33,1017,0,'Check 111111','check-111111',0,1445480400,'Check check check',1412220547,1,NULL,0,2),(19,1017,0,'Dating voi cai ten thiet dai oi la dai de test ne','dating-voi-cai-ten-thiet-dai-oi-la-dai-de-test-ne',0,1416972900,'Theo cáo trạng chuyển sang tòa, nghi can Tường bị truy tố về hai tội Xâm phạm thi thể, mồ mả, hài cốt (điều 246 Bộ luật Hình sự) và Vi phạm quy định về khám bệnh, chữa bệnh, sản xuất pha chế thuốc, cấp phát thuốc, bán thuốc hoặc dịch vụ y tế khác (điều 242). Bị can Khánh đối mặt cáo buộc Xâm phạm thi thể, mồ mả, trộm cắp tài sản.',1406521536,1,NULL,0,0),(31,1023,0,'Cuong Le Check','cuong-le-check',0,1416493200,'sd fsdfsdfsd fsd',1409795955,1,NULL,0,0),(32,1023,0,'Thu','thu',0,1416579600,'asd sdasd asd ad',1409801113,1,0,0,1),(17,1017,0,'Post dating 01','post-dating-01',0,1404094800,'Test post dating, hehehehe',1403230654,1,NULL,0,0),(18,1017,0,'Check','check',34,1416277200,'Check',1404352126,1,NULL,0,2),(16,1017,0,'Test dating 24h','test-dating-24h',0,1404094800,'Test dating 24h changed to public',1402884933,1,0,1402884933,0),(34,1023,0,'Moi VIP Cuong Cuong','moi-vip-cuong-cuong',0,1414721400,'Check asdasdas asd asdasd a',1413952403,1,0,1413952403,0);

/*Table structure for table `dating_apply` */

DROP TABLE IF EXISTS `dating_apply`;

CREATE TABLE `dating_apply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dating_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Data for the table `dating_apply` */

insert  into `dating_apply`(`id`,`dating_id`,`user_id`,`status`) values (16,33,1023,1),(14,18,1023,-1),(12,18,1017,1);

/*Table structure for table `deal` */

DROP TABLE IF EXISTS `deal`;

CREATE TABLE `deal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `title` text,
  `description` text NOT NULL,
  `old_price` double NOT NULL,
  `new_price` double NOT NULL,
  `end_date` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `quantitybuy` int(11) DEFAULT '0',
  `image1` varchar(255) DEFAULT NULL,
  `image2` varchar(255) DEFAULT NULL,
  `image3` varchar(255) DEFAULT NULL,
  `image4` varchar(255) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `b2b_id` int(11) NOT NULL,
  `expiry` tinyint(4) NOT NULL,
  `time` int(11) NOT NULL,
  `publish` tinyint(4) NOT NULL,
  `ordering` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `deal` */

insert  into `deal`(`id`,`name`,`alias`,`title`,`description`,`old_price`,`new_price`,`end_date`,`quantity`,`quantitybuy`,`image1`,`image2`,`image3`,`image4`,`category_id`,`b2b_id`,`expiry`,`time`,`publish`,`ordering`) values (3,'Deal 1','deal-1','Title deal 01','<p>\r\n I forbindelse med bestilling af voucher v&aelig;rdibeviset, skal kunden angive navn, adresse, e-mailadresse, konto - og kortoplysninger med kortnummer, kortets udl&oslash;bsdato og kortets kontrolcifre.</p>\r\n<p>\r\n N&aring;r kundens bestilling er registreret hos Sugardating.COM og REDDOCKS MEDIA, fremsendes en ordrebekr&aelig;ftelse til kunden pr. e-mail. Den indeholder blandt andet et ordrenummer, navn og adresse p&aring; betaleren, betalingsmetode samt en oversigt over det k&oslash;bte. I tilf&aelig;lde af, at kunden ikke modtager en ordrebekr&aelig;ftelse, skal kunden kontakte Sugardating.COM. Ordrenummeret skal oplyses i forbindelse med al korrespondance med Sugardating. Der foreligger f&oslash;rst et retsm&aelig;ssigt salg af voucher v&aelig;rdibeviset, n&aring;r Sugardating har registreret kundens betaling.</p>\r\n<p>\r\n Umiddelbart efter at betalingen er registreret p&aring; Sugardating.COM og REDDOCKS MEDIA&rsquo;s konto og k&oslash;bet s&aring;ledes er gennemf&oslash;rt, vil et unikt link til voucher v&aelig;rdibeviset blive sendt pr. e-mail til kunden. Ved afsendelsen anvendes den e-mail adresse, som kunden har angivet under bestillingen.</p>\r\n',2,1,1419960600,10,10,'46cc52570da8759758eb72cb8558eea6.jpg','','','b448341a043c468d71b784120cabd1b4.jpg',1,1003,0,1380011516,1,1),(4,'Deal 2','deal-2','','<p>\r\n L&aelig;kker middag for 1</p>\r\n',2,1,1403112600,5,1,'cac8a4fb8f8e6612712a7e77b211d4b1.jpg','948fd4c51c88fcfe62319c3dadf9df6b.jpg','d18672b53da90ac93608a9bf52c1bda7.jpg','1a5a188035f109613a67af969953c083.jpg',2,1003,0,1382516953,1,2),(5,'Deal 3','deal-3','Title for deal','<p>\r\n L&aelig;kker middag for 1</p>\r\n',10,2,1410370200,8,0,'3e9b0127c9cf7cdcb12503d90ebbcec1.jpg','8d8be82f0c7ef581b0d6e078cb14ffd5.jpg','0ebda6a3571e6765b2a8d2f9da792a67.jpg','7c1d8602ceb20435633fe0f3a53742ac.jpg',3,1002,0,1382517216,1,3),(6,'Deal 4','deal-4','Title for deal here and here','<p>\r\n L&aelig;kker middag for 1</p>\r\n',25,2,1449682200,20,1,'d35bbc5f8bbb7f3e8afa8cfaed9ab4a1.jpg','42aa33e82843f4765fda54677ee88f0d.jpg','097323d8864ef2a1abd5cc0604f75d73.jpg','9874cb3f87f91bdaf4904427ac3150b3.jpg',4,1002,0,1382947139,1,4),(7,'Deal 5','deal-5','Mô tả ngắn cho deal','<p>\r\n L&aelig;kker middag for 1</p>\r\n',1000,800,1413999000,10,0,'c264741d9cb62ec2e07614d4a118ce87.jpg','be048d2b7ae36dbb13f7a6965e91ce4a.jpg','73cd04417de0382c5f0870f18acc1929.jpg','84ddbf8f2b8250d34d0fd7724cf0943b.jpg',5,1002,0,1382947197,1,5),(8,'Deal new test long to name','deal-new-test-long-to-name','Title for deal here','<p>\r\n Đẳng cấp, chuy&ecirc;n nghiệp hay bất t&iacute;n, lừa đảo,&hellip; một trong những trang thương mại điện tử đ&igrave;nh đ&aacute;m, Lazada Việt Nam c&oacute; h&agrave;ng trăm c&acirc;u chuyện để n&oacute;i về 2 năm ph&aacute;t triển tại thị trường Việt Nam. Cuộc tấn c&ocirc;ng thần tốc Th&agrave;nh lập v&agrave;o th&aacute;ng 02 năm 2012, trang Thương mại điện tử (TMĐT) Lazada.vn l&agrave; th&agrave;nh vi&ecirc;n của hệ thống b&aacute;n lẻ Lazada Đ&ocirc;ng Nam &Aacute; c&ugrave;ng với Malaysia, Indonesia, Philippines v&agrave; Th&aacute;i Lan. G&acirc;y ấn tượng đầu ti&ecirc;n với người d&ugrave;ng l&agrave; giao diện sinh động, sản phẩm phong ph&uacute; thuộc nhiều</p>\r\n',2,1,1402507800,10,2,'36f1eca05191c313b6274639c4930e9b.jpg','77581b1174431809d2f9809cc7fc9df7.jpg',NULL,NULL,1,1003,0,1395799441,1,6);

/*Table structure for table `deal_category` */

DROP TABLE IF EXISTS `deal_category`;

CREATE TABLE `deal_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `white_icon` varchar(255) DEFAULT NULL,
  `red_icon` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `publish` tinyint(4) NOT NULL,
  `ordering` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

/*Data for the table `deal_category` */

insert  into `deal_category`(`id`,`name`,`alias`,`white_icon`,`red_icon`,`time`,`publish`,`ordering`) values (1,'Movie, Theater and Entertainment','movie-theater-and-entertainment','dd7d43bfa36f8d14f9ee45efe9b4b0f9.png','b97336215c8547a536223a8d6df47aac.png',1379557476,1,1),(2,'Brunch','brunch','61e0194109245125b651ad88663fdf9c.png','7b1a2254e95767bcdde993fb301ccf7d.png',1379557590,1,2),(3,'Café and coffee','caf-and-coffee','c7c9fe469705ceed22d91f9f1551f38b.png','b2a05dde9e92d151232c40f9f2a5f0db.png',1379565052,1,3),(4,'Wine bar','wine-bar','9beb0747f9edc4d2418920bff58b706f.png','eb0003fff7bc91ac3e0c9d136c2738d7.png',1379565107,1,4),(5,'Dinner and restaurent','dinner-and-restaurent','34067bc8ee3f4d688941b864b865976e.png','cedc58e751d655f9ca7dfe4028534da5.png',1379565127,1,5),(6,'Snack','snack','afaf57da65712566beac389ef962435b.png','c3dddf646d3e4fd078cc26385da318de.png',1379565149,1,6),(7,'Travel','travel','02afbea241bd2e9895246273f61098b3.png','41cf8b8b84e264371935840cc954e946.png',1379565165,1,7),(8,'Weekend getaway','weekend-getaway','5465b4b8782e5b31f0e2d6301aaddda1.png','6f86a045fc9ac4daf678db0e2ba685d0.png',1379565204,1,8),(9,'Outdoor','outdoor','78ab11438ce6df97e36d2048fd5042e3.png','f7ee7e385d6b5e2003ec7ed89c902415.png',1379565232,1,9),(10,'Sports','sports','de6de3f9262b07566be8847ef8aa5f66.png','ba0fa352145546890ef562f6090d8bbb.png',1379565250,1,10),(11,'Other activities','other-activities','10c4b24b40581deaeb80a79b7039bdf0.png','5da80ed00420481521a0def7ea7ba2a1.png',1379565275,1,11),(12,'Wellness','wellness','704a09516ae2513c3ec10b9eff54d121.png','1a466ce409e9a7fdfdca0ed04bd7e05b.png',1379565293,1,12),(13,'Leisure','leisure','8705dfc983f1cc85ba023ab22c8fdc63.png','cadfe9bfa63f751d308dc6770b08c171.png',1379565333,1,13),(14,'Spoil','spoil','2f089317bb2c6aa42a618e7bcb78859c.png','187b703448b711ff14c9f40cdb089826.png',1379565373,1,14),(15,'Culture','culture','1942e394134fb4177a4509c0a3bb4473.png','4c9725d27d1fcdb238dce431bfae9355.png',1379565387,1,15),(16,'Events','events','98b90b2c9fb834d942a15a64933cd197.png','6e1ef735b3d4d16133eca6d64b7690f0.png',1379565406,1,16),(17,'Action Packed','action-packed','747ab88396d6763862014d80e16fbbf6.png','24d0eefebd4648ab756d157d74ad40c0.png',1379565426,1,17),(18,'Fun','fun','f6745cf19e12cdde04dee63c714b6337.png','bf60b80fc45d0aa3575976cff49f360a.png',1379565439,1,18),(19,'Extraordinary','extraordinary','76dc665a95fc5299a68e5bb603abf8dc.png','954ee4f633f4068f7cdec240bf74a3f0.png',1379565477,1,19),(20,'Sweet','sweet','0ac7a37d9002d2960235e667e61083ae.png','67c218bc250f00a8d97387a2c07268e6.png',1379565492,1,20),(21,'Sexy','sexy','3f42d8c549d407e6a99db295f87ecff5.png','90bd0559874de8e8db05093cf886a07a.png',1379565508,1,21),(22,'Naughty','naughty','5265f480e096c2b7022e58c6ba2df1ef.png','2aa0205bd4254850bccfd7e6ce82af8d.png',1379565531,1,22),(23,'Miscellaneous/ something else','miscellaneous-something-else','f86c597d5b94618cb66b85b3475ebbeb.png','957f46f2460d6aabfe472f1202debdd9.png',1379565584,1,23),(24,'Heart','heart',NULL,'724b7666efdbb68edbf7c7cd9233216c.png',1379565622,1,24);

/*Table structure for table `faq` */

DROP TABLE IF EXISTS `faq`;

CREATE TABLE `faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `publish` tinyint(4) NOT NULL,
  `ordering` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `faq` */

/*Table structure for table `friend_request` */

DROP TABLE IF EXISTS `friend_request`;

CREATE TABLE `friend_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `friend_request` */

insert  into `friend_request`(`id`,`from_id`,`to_id`,`time`) values (1,1023,1015,1396518665),(2,1017,1015,1404202636),(5,1023,1017,1409798335);

/*Table structure for table `friends` */

DROP TABLE IF EXISTS `friends`;

CREATE TABLE `friends` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `friends` */

insert  into `friends`(`id`,`from_id`,`to_id`,`time`) values (3,1014,1015,1387440595),(4,1015,1014,1387440595),(11,1023,1017,1409797913),(12,1017,1023,1409797913);

/*Table structure for table `gallery` */

DROP TABLE IF EXISTS `gallery`;

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `publish` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;

/*Data for the table `gallery` */

insert  into `gallery`(`id`,`user_id`,`image`,`time`,`publish`) values (13,1015,'81637be64628444d214f90cd6d3068d7.jpg',1377661871,1),(12,1015,'19b602a7d25e16e4e728de1791041801.jpg',1377661871,1),(11,1015,'9a3892f445eaae9830c25441822619ac.jpg',1377661825,1),(30,1015,'b26413ae7aa683775387cd41443cd3d2.jpeg',1387448564,1),(29,1015,'e57c48c373c3f2daa0963c9db88789be.jpg',1387448564,1),(18,1014,'4e162694a978e70ec35727f7148e1b0e.jpeg',1385608918,1),(19,1014,'b29954d485734faa94a5b16455cdcd75.jpg',1385608918,1),(20,1014,'951ce21db33742d29c749728977d4fe0.jpeg',1385608918,1),(31,1015,'fcfce990dc37e7bed3b034697f6272a3.jpeg',1387448564,1),(57,1017,'86f4dc86c036715238f5cb8a61a7fdcb.jpg',1410421819,1),(56,1017,'9311a4c307a4271fccc3992ba0fdff99.jpg',1410421819,1),(47,1017,'57cde4d6730de81600626c46b5bb7054.jpg',1410421819,1),(48,1017,'88d97ef5a218e45bae622f3d5d7f9ec2.jpg',1410421819,1),(49,1017,'f12fa44403784585f16896a384443fcd.jpg',1410421819,1),(50,1017,'98b19a63d31e23887c65e2115f4e1316.jpg',1410421819,1),(51,1017,'aa37a96ae82deae068449ca899cad40a.jpg',1410421819,1),(52,1017,'a38149edfe22c63ce6e058d23bec0c15.jpg',1410421819,1),(53,1017,'3ac2e1387f286400fa4f611c46e98abd.jpg',1410421819,1),(54,1017,'f2c5acf556d9413bd50a8004d7d0500c.jpg',1410421819,1),(55,1017,'2b63e94304a1288af0ec7714800a8655.jpg',1410421819,1),(58,1017,'39446395738c4c467ea9f3677f359839.jpg',1410421819,1),(59,1017,'f3901de4cd52b59635dba7e1fe975479.jpg',1410421819,1),(60,1017,'082dc2d6d1d9690bf1a8af82e081f531.jpg',1410421819,1),(61,1017,'530af4c40048e929b55414128da17922.jpg',1410421819,1),(62,1017,'990a0b9f8fee7711a87dc2b078f88aa3.jpg',1410421819,1),(63,1017,'3ca67c79ddc0e9e3d0dfe626597f1ae7.jpg',1410421820,1),(64,1017,'8875b0eaf9914d498e8321184a121979.jpg',1410421820,1),(65,1017,'9bcb1d16bc8a223d30722748c588418e.jpg',1410421820,1),(66,1017,'6ebec7071ad4d26dbed99b075992bc97.jpg',1410421820,1),(67,1017,'5e0c965c15b33ed1a018bb3e94b302d3.jpg',1410421820,1),(68,1017,'fd8c0f54a83efe7cfd366c7119b52070.jpg',1410421820,1),(69,1017,'02b96f8d631bbac34953a8764892cdc1.jpg',1410421820,1);

/*Table structure for table `mail_template` */

DROP TABLE IF EXISTS `mail_template`;

CREATE TABLE `mail_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `publish` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `mail_template` */

insert  into `mail_template`(`id`,`title`,`content`,`publish`) values (1,'forgot_password','Kære <b><?php echo $data[\'name\']?></b><br /><br />\r\n \r\nKlik på dette link for at ændre ny adgangskode <a href=\"<?php echo $data[\'link\']?>\"><?php echo $data[\'link\']?></a><br /><br />\r\n\r\nHar du spørgsmål kontakt support@sugardating.dk<br /><br />\r\n\r\nMed venlig hilsen<br/>\r\nChristina<br/>\r\n<a href=\"<?php echo $data[\'site\'];?>\">Sugardating.dk</a>\r\n',1),(2,'help','Kære <b><?php echo $data[\'name\']?></b>, <b><?php echo $data[\'email\']?></b><br /><br />\r\n\r\nTak for dit spørgsmål:<br />\r\n<?php echo $data[\'besked\']?>\r\n<br /><br />\r\n\r\nJeg vender hurtigst muligt tilbage til dig.<br /><br />\r\n\r\nMen bliv nu ikke hængende her og vent. Gå hellere på opdagelse i Sugardating.dk.<br />\r\nMåske har en Sugardate profil inviteret dig ud. Måske er der lige kommet en ny Sugardate profil, <br />\r\nsom du kan blive den første til at invitere ud. Det er det hele værd. Du er det hele værd!<br /><br />\r\n\r\n<a href=\"<?php echo $data[\'login\'];?>\">Gå direkte til login lige hér</a><br /><br />\r\n\r\nMed venlig hilsen<br />\r\nChristina<br />\r\n<a href=\"<?php echo $data[\'site\'];?>\">Sugardating.dk</a>',1),(3,'kontakt','Kære <b><?php echo $data[\'name\']?></b>, <b><?php echo $data[\'email\']?></b><br /><br />\r\n\r\nTak for din henvendelse:<br />\r\n<?php echo $data[\'besked\']?>\r\n<br /><br />\r\nJeg vender hurtigst muligt tilbage til dig.<br />\r\nMen bliv nu ikke hængende her og vent. Gå hellere på opdagelse i Sugardating.dk.<br />\r\nMåske har en Sugardate profil inviteret dig ud. Måske er der lige kommet en ny Sugardate profil,<br />\r\nsom du kan blive den første til at invitere ud. Det er det hele værd. Du er det hele værd!<br />\r\n\r\n<a href=\"<?php echo $data[\'login\'];?>\">Gå direkte til login lige hér</a><br /><br />\r\n\r\nMed venlig hilsen<br />\r\nChristina<br />\r\n<a href=\"<?php echo $data[\'site\'];?>\">Sugardating.dk</a>',1),(5,'signupb2b','Kære <b><?php echo $data[\'name\'];?></b><br/>\r\n<h3>VELKOMMEN!</h3>\r\n\r\nDu er blevet tilføjet som ny bruger på Sugar Dating af en Administrator.<br/><br/>\r\nDenne email indeholder dit brugernavn og din adgangskode til at logge på <?php echo $data[\'link\'];?><br/><br/>\r\n\r\nBrugernavn: <b> <?php echo $data[\'email\'];?> </b> <br/>\r\nAdgangskode: <b> <?php echo $data[\'pass\'];?> </b><br/><br/>\r\n\r\nSvar venligst ikke på denne email da den er genereret automatisk og kun er sendt som informationsmail.<br/><br/>\r\n\r\nMed venlig hilsen<br/>\r\nChristina<br/>\r\n<a href=\"<?php echo $data[\'site\'];?>\">Sugardating.dk</a>',0),(6,'signup','Kære <b><?php echo $data[\'name\'];?></b><br/>\r\n<h3>VELKOMMEN!</h3>\r\nDu er nu medlem af Sugardating.dk<br/>\r\nJeg er glad for at være den første til at byde dig indenfor!<br/><br/>\r\n\r\nHér er dine login oplysninger:<br/>\r\nE-mail: <b><?php echo $data[\'email\'];?></b><br/>\r\nPassword: <b><?php echo $data[\'password\'];?></b><br/><br/>\r\n\r\nDu kan logge ind på Sugardating.dk med det samme<br/><br/>\r\n\r\n<a href=\"<?php echo $data[\'login\'];?>\">Gå direkte til login lige hér</a><br/><br/>\r\n\r\nSom Sugarmedlem har du nu adgang til at lege varmt, og kan udleve dine fantasier med din egen Sugar <br/>\r\nDate. Vær dig selv og sig hvad du vil ha\' på Sugardating.dk. Gå på opdagelse. Find ud af hvilken leg der er <br/>\r\nsjov for dig og udlev det! Det er det hele værd. Du er det hele værd! Og hvorfor nøjes? Du fortjener kun det <br/>\r\nbedste!<br/><br/>\r\n\r\nKommer du i tvivl om noget, kan du altid spørge Christina@sugardating.dk eller hos <br/>\r\nKundeservice@sugardating.dk<br/><br/>\r\n\r\nMed venlig hilsen<br/>\r\nChristina<br/>\r\n<a href=\"<?php echo $data[\'site\'];?>\">Sugardating.dk</a>\r\n',0);

/*Table structure for table `messages` */

DROP TABLE IF EXISTS `messages`;

CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `attach_dating` int(11) NOT NULL,
  `accept` tinyint(4) DEFAULT '0',
  `seen` tinyint(4) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

/*Data for the table `messages` */

insert  into `messages`(`id`,`from_id`,`to_id`,`message`,`attach_dating`,`accept`,`seen`,`time`) values (1,1015,1014,'aaaa',0,0,1,1386145951),(2,1015,1014,'aaa',0,0,1,1386145979),(3,1014,1015,'hello anybody here?',0,0,1,1386148806),(5,1015,1017,'hello?',0,0,1,1386216940),(6,1015,1017,'aaaaa',0,0,1,1386216991),(7,1015,1017,'ddd',0,0,1,1386217015),(8,1017,1015,'asdsdasdsa',0,0,1,1386217279),(9,1017,1015,'asdsadsad',0,0,1,1386217281),(10,1017,1015,'asdsadasd',0,0,1,1386217283),(11,1017,1015,'qweq e qwe qwe',0,0,1,1386217288),(12,1015,1014,'bbb',0,0,1,1386232606),(13,1015,1014,'1',0,0,1,1387854576),(14,1015,1014,'2',0,0,1,1387854578),(15,1015,1014,'3',0,0,1,1387854580),(16,1015,1014,'4',0,0,1,1387854581),(17,1015,1014,'5',0,0,1,1387854582),(18,1015,1014,'6',0,0,1,1387857773),(19,1017,1023,'helu',0,0,1,1403058258),(20,1023,1017,'kaka',0,0,1,1403058285),(21,1017,1023,'helu',0,0,1,1406532028),(22,1017,1023,'kaka',0,0,1,1406532032),(23,1023,1017,'gì ku',0,0,1,1406532134);

/*Table structure for table `order` */

DROP TABLE IF EXISTS `order`;

CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderID` varchar(255) NOT NULL,
  `cat_id` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `total` double NOT NULL,
  `status` tinyint(4) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

/*Data for the table `order` */

insert  into `order`(`id`,`orderID`,`cat_id`,`user_id`,`total`,`status`,`time`) values (17,'S1395806477','1,',1017,1,1,1395806477),(18,'S1396420702','2,1,',1017,2,1,1396420702),(19,'S1396487827','1,4,',1023,3,1,1396487827),(20,'S1397717097','3,',1017,2,0,1397717108),(21,'S1398050703','3,',1017,2,0,1398052019),(22,'S1398224522','3,',1017,2,0,1398224641),(23,'S1403080947','3,',1017,2,0,1403080947);

/*Table structure for table `order_item` */

DROP TABLE IF EXISTS `order_item`;

CREATE TABLE `order_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `deal_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `old_price` double NOT NULL,
  `new_price` double NOT NULL,
  `subtotal` double NOT NULL,
  `namegift` varchar(255) DEFAULT NULL,
  `emailgift` varchar(100) DEFAULT NULL,
  `sendtomail` int(11) DEFAULT NULL,
  `fromgift` varchar(255) DEFAULT NULL,
  `textgift` text,
  `codes` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `used` int(11) DEFAULT '0',
  `times` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

/*Data for the table `order_item` */

insert  into `order_item`(`id`,`order_id`,`deal_id`,`category_id`,`name`,`quantity`,`old_price`,`new_price`,`subtotal`,`namegift`,`emailgift`,`sendtomail`,`fromgift`,`textgift`,`codes`,`status`,`used`,`times`) values (34,17,3,1,'Deal 1',1,2,1,1,'','',0,'','','SG-390753173-49053',0,1,1395806477),(35,18,4,2,'Deal 2',1,2,1,1,'','',0,'','','SG-731713867-55837',0,0,1396420702),(36,18,8,1,'Deal new test long to name',1,2,1,1,'','',0,'','','SG-775604248-64555',1,0,1396420702),(37,19,8,1,'Deal new test long to name',1,2,1,1,'','',0,'','','SG-522671508-31494',0,0,1396487827),(38,19,6,4,'Deal 4',1,25,2,2,'','',0,'','','SG-440219116-91826',0,0,1396487827),(40,20,5,3,'Deal 3',1,10,2,2,'','',0,'','','SG-770330810-97074',0,0,1397717108),(43,21,5,3,'Deal 3',1,10,2,2,'','',0,'','','SG-163116455-42813',0,0,1398052019),(46,22,5,3,'Deal 3',1,10,2,2,'','',0,'','','SG-911093139-15603',0,0,1398224641),(47,23,5,3,'Deal 3',1,10,2,2,'','',0,'','','SG-7207-1372',0,0,1403080947);

/*Table structure for table `order_item_code` */

DROP TABLE IF EXISTS `order_item_code`;

CREATE TABLE `order_item_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_item_id` int(11) NOT NULL,
  `codes` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `times` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `order_item_code` */

/*Table structure for table `postnumber` */

DROP TABLE IF EXISTS `postnumber`;

CREATE TABLE `postnumber` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1246 DEFAULT CHARSET=utf8;

/*Data for the table `postnumber` */

insert  into `postnumber`(`id`,`number`,`city`) values (1,'1000','København K'),(2,'1001','København K'),(3,'1002','København K'),(4,'1003','København K'),(5,'1004','København K'),(6,'1005','København K'),(7,'1006','København K'),(8,'1007','København K'),(9,'1008','København K'),(10,'1009','København K'),(11,'1010','København K'),(12,'1011','København K'),(13,'1012','København K'),(14,'1013','København K'),(15,'1014','København K'),(16,'1015','København K'),(17,'1016','København K'),(18,'1017','København K'),(19,'1018','København K'),(20,'1019','København K'),(21,'1020','København K'),(22,'1021','København K'),(23,'1022','København K'),(24,'1023','København K'),(25,'1024','København K'),(26,'1025','København K'),(27,'1026','København K'),(28,'1045','København K'),(29,'1050','København K'),(30,'1051','København K'),(31,'1052','København K'),(32,'1053','København K'),(33,'1054','København K'),(34,'1055','København K'),(35,'1055','København K'),(36,'1056','København K'),(37,'1057','København K'),(38,'1058','København K'),(39,'1059','København K'),(40,'1060','København K'),(41,'1061','København K'),(42,'1062','København K'),(43,'1063','København K'),(44,'1064','København K'),(45,'1065','København K'),(46,'1066','København K'),(47,'1067','København K'),(48,'1068','København K'),(49,'1069','København K'),(50,'1070','København K'),(51,'1071','København K'),(52,'1072','København K'),(53,'1073','København K'),(54,'1074','København K'),(55,'1092','København K'),(56,'1093','København K'),(57,'1095','København K'),(58,'1098','København K'),(59,'1100','København K'),(60,'1101','København K'),(61,'1102','København K'),(62,'1103','København K'),(63,'1104','København K'),(64,'1105','København K'),(65,'1106','København K'),(66,'1107','København K'),(67,'1110','København K'),(68,'1111','København K'),(69,'1112','København K'),(70,'1113','København K'),(71,'1114','København K'),(72,'1115','København K'),(73,'1116','København K'),(74,'1117','København K'),(75,'1118','København K'),(76,'1119','København K'),(77,'1120','København K'),(78,'1121','København K'),(79,'1122','København K'),(80,'1123','København K'),(81,'1124','København K'),(82,'1125','København K'),(83,'1126','København K'),(84,'1127','København K'),(85,'1128','København K'),(86,'1129','København K'),(87,'1130','København K'),(88,'1131','København K'),(89,'1140','København K'),(90,'1147','København K'),(91,'1148','København K'),(92,'1150','København K'),(93,'1151','København K'),(94,'1152','København K'),(95,'1153','København K'),(96,'1154','København K'),(97,'1155','København K'),(98,'1156','København K'),(99,'1157','København K'),(100,'1158','København K'),(101,'1159','København K'),(102,'1160','København K'),(103,'1161','København K'),(104,'1162','København K'),(105,'1163','København K'),(106,'1164','København K'),(107,'1165','København K'),(108,'1166','København K'),(109,'1167','København K'),(110,'1168','København K'),(111,'1169','København K'),(112,'1170','København K'),(113,'1171','København K'),(114,'1172','København K'),(115,'1173','København K'),(116,'1174','København K'),(117,'1175','København K'),(118,'1200','København K'),(119,'1201','København K'),(120,'1202','København K'),(121,'1203','København K'),(122,'1204','København K'),(123,'1205','København K'),(124,'1206','København K'),(125,'1207','København K'),(126,'1208','København K'),(127,'1209','København K'),(128,'1210','København K'),(129,'1211','København K'),(130,'1212','København K'),(131,'1213','København K'),(132,'1214','København K'),(133,'1215','København K'),(134,'1216','København K'),(135,'1217','København K'),(136,'1218','København K'),(137,'1218','København K'),(138,'1218','København K'),(139,'1218','København K'),(140,'1218','København K'),(141,'1218','København K'),(142,'1219','København K'),(143,'1220','København K'),(144,'1221','København K'),(145,'1240','København K'),(146,'1250','København K'),(147,'1251','København K'),(148,'1252','København K'),(149,'1253','København K'),(150,'1254','København K'),(151,'1255','København K'),(152,'1256','København K'),(153,'1257','København K'),(154,'1258','København K'),(155,'1259','København K'),(156,'1259','København K'),(157,'1260','København K'),(158,'1261','København K'),(159,'1263','København K'),(160,'1263','København K'),(161,'1264','København K'),(162,'1265','København K'),(163,'1266','København K'),(164,'1267','København K'),(165,'1268','København K'),(166,'1270','København K'),(167,'1271','København K'),(168,'1291','København K'),(169,'1300','København K'),(170,'1301','København K'),(171,'1302','København K'),(172,'1303','København K'),(173,'1304','København K'),(174,'1306','København K'),(175,'1307','København K'),(176,'1307','København K'),(177,'1308','København K'),(178,'1309','København K'),(179,'1310','København K'),(180,'1311','København K'),(181,'1312','København K'),(182,'1313','København K'),(183,'1314','København K'),(184,'1315','København K'),(185,'1316','København K'),(186,'1317','København K'),(187,'1318','København K'),(188,'1319','København K'),(189,'1320','København K'),(190,'1321','København K'),(191,'1322','København K'),(192,'1323','København K'),(193,'1324','København K'),(194,'1325','København K'),(195,'1326','København K'),(196,'1327','København K'),(197,'1328','København K'),(198,'1329','København K'),(199,'1349','København K'),(200,'1350','København K'),(201,'1352','København K'),(202,'1353','København K'),(203,'1354','København K'),(204,'1355','København K'),(205,'1356','København K'),(206,'1357','København K'),(207,'1358','København K'),(208,'1359','København K'),(209,'1360','København K'),(210,'1361','København K'),(211,'1361','København K'),(212,'1362','København K'),(213,'1363','København K'),(214,'1364','København K'),(215,'1365','København K'),(216,'1366','København K'),(217,'1367','København K'),(218,'1368','København K'),(219,'1369','København K'),(220,'1370','København K'),(221,'1371','København K'),(222,'1400','København K'),(223,'1400','København K'),(224,'1401','København K'),(225,'1402','København K'),(226,'1402','København K'),(227,'1402','København K'),(228,'1402','København K'),(229,'1402','København K'),(230,'1403','København K'),(231,'1404','København K'),(232,'1405','København K'),(233,'1406','København K'),(234,'1407','København K'),(235,'1408','København K'),(236,'1409','København K'),(237,'1410','København K'),(238,'1411','København K'),(239,'1411','København K'),(240,'1412','København K'),(241,'1413','København K'),(242,'1414','København K'),(243,'1415','København K'),(244,'1416','København K'),(245,'1417','København K'),(246,'1418','København K'),(247,'1419','København K'),(248,'1420','København K'),(249,'1421','København K'),(250,'1422','København K'),(251,'1423','København K'),(252,'1424','København K'),(253,'1425','København K'),(254,'1426','København K'),(255,'1427','København K'),(256,'1428','København K'),(257,'1429','København K'),(258,'1430','København K'),(259,'1431','København K'),(260,'1432','København K'),(261,'1432','København K'),(262,'1432','København K'),(263,'1433','København K'),(264,'1433','København K'),(265,'1433','København K'),(266,'1433','København K'),(267,'1433','København K'),(268,'1433','København K'),(269,'1433','København K'),(270,'1434','København K'),(271,'1435','København K'),(272,'1436','København K'),(273,'1436','København K'),(274,'1436','København K'),(275,'1436','København K'),(276,'1436','København K'),(277,'1436','København K'),(278,'1436','København K'),(279,'1437','København K'),(280,'1437','København K'),(281,'1437','København K'),(282,'1437','København K'),(283,'1437','København K'),(284,'1437','København K'),(285,'1437','København K'),(286,'1437','København K'),(287,'1437','København K'),(288,'1437','København K'),(289,'1437','København K'),(290,'1437','København K'),(291,'1437','København K'),(292,'1437','København K'),(293,'1438','København K'),(294,'1438','København K'),(295,'1438','København K'),(296,'1438','København K'),(297,'1438','København K'),(298,'1438','København K'),(299,'1439','København K'),(300,'1439','København K'),(301,'1439','København K'),(302,'1439','København K'),(303,'1439','København K'),(304,'1439','København K'),(305,'1439','København K'),(306,'1439','København K'),(307,'1439','København K'),(308,'1439','København K'),(309,'1439','København K'),(310,'1439','København K'),(311,'1440','København K'),(312,'1440','København K'),(313,'1440','København K'),(314,'1440','København K'),(315,'1440','København K'),(316,'1440','København K'),(317,'1440','København K'),(318,'1440','København K'),(319,'1440','København K'),(320,'1440','København K'),(321,'1440','København K'),(322,'1441','København K'),(323,'1441','København K'),(324,'1441','København K'),(325,'1448','København K'),(326,'1450','København K'),(327,'1451','København K'),(328,'1452','København K'),(329,'1453','København K'),(330,'1454','København K'),(331,'1455','København K'),(332,'1456','København K'),(333,'1457','København K'),(334,'1458','København K'),(335,'1459','København K'),(336,'1460','København K'),(337,'1461','København K'),(338,'1462','København K'),(339,'1463','København K'),(340,'1464','København K'),(341,'1465','København K'),(342,'1466','København K'),(343,'1467','København K'),(344,'1468','København K'),(345,'1470','København K'),(346,'1471','København K'),(347,'1472','København K'),(348,'1473','København K'),(349,'1500','København V'),(350,'1501','København V'),(351,'1502','København V'),(352,'1503','København V'),(353,'1504','København V'),(354,'1505','København V'),(355,'1506','København V'),(356,'1507','København V'),(357,'1508','København V'),(358,'1509','København V'),(359,'1510','København V'),(360,'1532','København V'),(361,'1533','København V'),(362,'1550','København V'),(363,'1550','København V'),(364,'1551','København V'),(365,'1552','København V'),(366,'1553','København V'),(367,'1553','København V'),(368,'1554','København V'),(369,'1555','København V'),(370,'1556','København V'),(371,'1557','København V'),(372,'1558','København V'),(373,'1559','København V'),(374,'1560','København V'),(375,'1561','København V'),(376,'1561','København V'),(377,'1562','København V'),(378,'1563','København V'),(379,'1564','København V'),(380,'1566','København V'),(381,'1567','København V'),(382,'1568','København V'),(383,'1569','København V'),(384,'1570','København V'),(385,'1570','København V'),(386,'1571','København V'),(387,'1572','København V'),(388,'1573','København V'),(389,'1574','København V'),(390,'1575','København V'),(391,'1576','København V'),(392,'1577','København V'),(393,'1592','København V'),(394,'1599','København V'),(395,'1600','København V'),(396,'1601','København V'),(397,'1602','København V'),(398,'1603','København V'),(399,'1604','København V'),(400,'1605','København V'),(401,'1606','København V'),(402,'1607','København V'),(403,'1608','København V'),(404,'1609','København V'),(405,'1610','København V'),(406,'1611','København V'),(407,'1612','København V'),(408,'1613','København V'),(409,'1614','København V'),(410,'1615','København V'),(411,'1616','København V'),(412,'1617','København V'),(413,'1618','København V'),(414,'1619','København V'),(415,'1620','København V'),(416,'1620','København V'),(417,'1621','København V'),(418,'1622','København V'),(419,'1623','København V'),(420,'1624','København V'),(421,'1630','København V'),(422,'1631','København V'),(423,'1632','København V'),(424,'1633','København V'),(425,'1634','København V'),(426,'1635','København V'),(427,'1640','København V'),(428,'1650','København V'),(429,'1651','København V'),(430,'1652','København V'),(431,'1653','København V'),(432,'1654','København V'),(433,'1655','København V'),(434,'1656','København V'),(435,'1657','København V'),(436,'1658','København V'),(437,'1659','København V'),(438,'1660','København V'),(439,'1660','København V'),(440,'1661','København V'),(441,'1662','København V'),(442,'1663','København V'),(443,'1664','København V'),(444,'1665','København V'),(445,'1666','København V'),(446,'1667','København V'),(447,'1668','København V'),(448,'1669','København V'),(449,'1670','København V'),(450,'1671','København V'),(451,'1671','København V'),(452,'1672','København V'),(453,'1673','København V'),(454,'1674','København V'),(455,'1675','København V'),(456,'1676','København V'),(457,'1677','København V'),(458,'1699','København V'),(459,'1700','København V'),(460,'1701','København V'),(461,'1702','København V'),(462,'1703','København V'),(463,'1704','København V'),(464,'1705','København V'),(465,'1706','København V'),(466,'1707','København V'),(467,'1708','København V'),(468,'1709','København V'),(469,'1710','København V'),(470,'1711','København V'),(471,'1712','København V'),(472,'1713','København V'),(473,'1714','København V'),(474,'1715','København V'),(475,'1716','København V'),(476,'1717','København V'),(477,'1718','København V'),(478,'1719','København V'),(479,'1720','København V'),(480,'1721','København V'),(481,'1722','København V'),(482,'1723','København V'),(483,'1724','København V'),(484,'1725','København V'),(485,'1726','København V'),(486,'1727','København V'),(487,'1728','København V'),(488,'1729','København V'),(489,'1730','København V'),(490,'1731','København V'),(491,'1732','København V'),(492,'1733','København V'),(493,'1734','København V'),(494,'1735','København V'),(495,'1736','København V'),(496,'1737','København V'),(497,'1738','København V'),(498,'1739','København V'),(499,'1748','København V'),(500,'1749','København V'),(501,'1750','København V'),(502,'1751','København V'),(503,'1752','København V'),(504,'1753','København V'),(505,'1754','København V'),(506,'1755','København V'),(507,'1756','København V'),(508,'1757','København V'),(509,'1758','København V'),(510,'1759','København V'),(511,'1760','København V'),(512,'1761','København V'),(513,'1762','København V'),(514,'1763','København V'),(515,'1764','København V'),(516,'1765','København V'),(517,'1766','København V'),(518,'1770','København V'),(519,'1771','København V'),(520,'1772','København V'),(521,'1773','København V'),(522,'1774','København V'),(523,'1775','København V'),(524,'1777','København V'),(525,'1778','København V'),(526,'1780','København V'),(527,'1782','København V'),(528,'1784','København V'),(529,'1785','København V'),(530,'1786','København V'),(531,'1787','København V'),(532,'1789','København V'),(533,'1790','København V'),(534,'1795','København V'),(535,'1799','København V'),(536,'1800','Frederiksberg C'),(537,'1801','Frederiksberg C'),(538,'1802','Frederiksberg C'),(539,'1803','Frederiksberg C'),(540,'1804','Frederiksberg C'),(541,'1805','Frederiksberg C'),(542,'1806','Frederiksberg C'),(543,'1807','Frederiksberg C'),(544,'1808','Frederiksberg C'),(545,'1809','Frederiksberg C'),(546,'1810','Frederiksberg C'),(547,'1811','Frederiksberg C'),(548,'1812','Frederiksberg C'),(549,'1813','Frederiksberg C'),(550,'1814','Frederiksberg C'),(551,'1815','Frederiksberg C'),(552,'1816','Frederiksberg C'),(553,'1817','Frederiksberg C'),(554,'1818','Frederiksberg C'),(555,'1819','Frederiksberg C'),(556,'1820','Frederiksberg C'),(557,'1822','Frederiksberg C'),(558,'1823','Frederiksberg C'),(559,'1824','Frederiksberg C'),(560,'1825','Frederiksberg C'),(561,'1826','Frederiksberg C'),(562,'1827','Frederiksberg C'),(563,'1828','Frederiksberg C'),(564,'1829','Frederiksberg C'),(565,'1835','Frederiksberg C'),(566,'1850','Frederiksberg C'),(567,'1851','Frederiksberg C'),(568,'1852','Frederiksberg C'),(569,'1853','Frederiksberg C'),(570,'1854','Frederiksberg C'),(571,'1855','Frederiksberg C'),(572,'1856','Frederiksberg C'),(573,'1857','Frederiksberg C'),(574,'1860','Frederiksberg C'),(575,'1861','Frederiksberg C'),(576,'1862','Frederiksberg C'),(577,'1863','Frederiksberg C'),(578,'1864','Frederiksberg C'),(579,'1865','Frederiksberg C'),(580,'1866','Frederiksberg C'),(581,'1867','Frederiksberg C'),(582,'1868','Frederiksberg C'),(583,'1870','Frederiksberg C'),(584,'1871','Frederiksberg C'),(585,'1872','Frederiksberg C'),(586,'1873','Frederiksberg C'),(587,'1874','Frederiksberg C'),(588,'1875','Frederiksberg C'),(589,'1876','Frederiksberg C'),(590,'1877','Frederiksberg C'),(591,'1878','Frederiksberg C'),(592,'1879','Frederiksberg C'),(593,'1900','Frederiksberg C'),(594,'1901','Frederiksberg C'),(595,'1902','Frederiksberg C'),(596,'1903','Frederiksberg C'),(597,'1904','Frederiksberg C'),(598,'1905','Frederiksberg C'),(599,'1906','Frederiksberg C'),(600,'1908','Frederiksberg C'),(601,'1909','Frederiksberg C'),(602,'1910','Frederiksberg C'),(603,'1911','Frederiksberg C'),(604,'1912','Frederiksberg C'),(605,'1913','Frederiksberg C'),(606,'1914','Frederiksberg C'),(607,'1915','Frederiksberg C'),(608,'1916','Frederiksberg C'),(609,'1917','Frederiksberg C'),(610,'1920','Frederiksberg C'),(611,'1921','Frederiksberg C'),(612,'1922','Frederiksberg C'),(613,'1923','Frederiksberg C'),(614,'1924','Frederiksberg C'),(615,'1925','Frederiksberg C'),(616,'1926','Frederiksberg C'),(617,'1927','Frederiksberg C'),(618,'1928','Frederiksberg C'),(619,'1931','Frederiksberg C'),(620,'1950','Frederiksberg C'),(621,'1951','Frederiksberg C'),(622,'1952','Frederiksberg C'),(623,'1953','Frederiksberg C'),(624,'1954','Frederiksberg C'),(625,'1955','Frederiksberg C'),(626,'1956','Frederiksberg C'),(627,'1957','Frederiksberg C'),(628,'1958','Frederiksberg C'),(629,'1959','Frederiksberg C'),(630,'1960','Frederiksberg C'),(631,'1961','Frederiksberg C'),(632,'1962','Frederiksberg C'),(633,'1963','Frederiksberg C'),(634,'1964','Frederiksberg C'),(635,'1965','Frederiksberg C'),(636,'1966','Frederiksberg C'),(637,'1967','Frederiksberg C'),(638,'1970','Frederiksberg C'),(639,'1971','Frederiksberg C'),(640,'1972','Frederiksberg C'),(641,'1973','Frederiksberg C'),(642,'1974','Frederiksberg C'),(643,'1999','Frederiksberg C'),(644,'2000','Frederiksberg'),(645,'2100','København Ø'),(646,'2200','København N'),(647,'2300','København S'),(648,'2400','København NV'),(649,'2450','København SV'),(650,'2500','Valby'),(651,'2600','Glostrup'),(652,'2605','Brøndby'),(653,'2610','Rødovre'),(654,'2620','Albertslund'),(655,'2625','Vallensbæk'),(656,'2630','Taastrup'),(657,'2635','Ishøj'),(658,'2640','Hedehusene'),(659,'2650','Hvidovre'),(660,'2660','Brøndby Strand'),(661,'2665','Vallensbæk Strand'),(662,'2670','Greve'),(663,'2680','Solrød Strand'),(664,'2690','Karlslunde'),(665,'2700','Brønshøj'),(666,'2720','Vanløse'),(667,'2730','Herlev'),(668,'2740','Skovlunde'),(669,'2750','Ballerup'),(670,'2760','Måløv'),(671,'2765','Smørum'),(672,'2770','Kastrup'),(673,'2791','Dragør'),(674,'2800','Kongens Lyngby'),(675,'2820','Gentofte'),(676,'2830','Virum'),(677,'2840','Holte'),(678,'2850','Nærum'),(679,'2860','Søborg'),(680,'2870','Dyssegård'),(681,'2880','Bagsværd'),(682,'2900','Hellerup'),(683,'2920','Charlottenlund'),(684,'2930','Klampenborg'),(685,'2942','Skodsborg'),(686,'2950','Vedbæk'),(687,'2960','Rungsted Kyst'),(688,'2970','Hørsholm'),(689,'2980','Kokkedal'),(690,'2990','Nivå'),(691,'3000','Helsingør'),(692,'3050','Humlebæk'),(693,'3060','Espergærde'),(694,'3070','Snekkersten'),(695,'3080','Tikøb'),(696,'3100','Hornbæk'),(697,'3120','Dronningmølle'),(698,'3140','Ålsgårde'),(699,'3150','Hellebæk'),(700,'3200','Helsinge'),(701,'3210','Vejby'),(702,'3220','Tisvildeleje'),(703,'3230','Græsted'),(704,'3250','Gilleleje'),(705,'3300','Frederiksværk'),(706,'3310','Ølsted'),(707,'3320','Skævinge'),(708,'3330','Gørløse'),(709,'3360','Liseleje'),(710,'3370','Melby'),(711,'3390','Hundested'),(712,'3400','Hillerød'),(713,'3450','Allerød'),(714,'3460','Birkerød'),(715,'3480','Fredensborg'),(716,'3490','Kvistgård'),(717,'3500','Værløse'),(718,'3520','Farum'),(719,'3540','Lynge'),(720,'3550','Slangerup'),(721,'3600','Frederikssund'),(722,'3630','Jægerspris'),(723,'3650','Ølstykke'),(724,'3660','Stenløse'),(725,'3670','Veksø Sjælland'),(726,'3700','Rønne'),(727,'3720','Aakirkeby'),(728,'3730','Nexø'),(729,'3740','Svaneke'),(730,'3751','Østermarie'),(731,'3760','Gudhjem'),(732,'3770','Allinge'),(733,'3782','Klemensker'),(734,'3790','Hasle'),(735,'4000','Roskilde'),(736,'4030','Tune'),(737,'4040','Jyllinge'),(738,'4050','Skibby'),(739,'4060','Kirke Såby'),(740,'4070','Kirke Hyllinge'),(741,'4100','Ringsted'),(742,'4105','Ringsted'),(743,'4129','Ringsted'),(744,'4130','Viby Sjælland'),(745,'4140','Borup'),(746,'4160','Herlufmagle'),(747,'4171','Glumsø'),(748,'4173','Fjenneslev'),(749,'4174','Jystrup Midtsj'),(750,'4180','Sorø'),(751,'4190','Munke Bjergby'),(752,'4200','Slagelse'),(753,'4220','Korsør'),(754,'4230','Skælskør'),(755,'4241','Vemmelev'),(756,'4242','Boeslunde'),(757,'4243','Rude'),(758,'4250','Fuglebjerg'),(759,'4261','Dalmose'),(760,'4262','Sandved'),(761,'4270','Høng'),(762,'4281','Gørlev'),(763,'4291','Ruds Vedby'),(764,'4293','Dianalund'),(765,'4295','Stenlille'),(766,'4296','Nyrup'),(767,'4300','Holbæk'),(768,'4320','Lejre'),(769,'4330','Hvalsø'),(770,'4340','Tølløse'),(771,'4350','Ugerløse'),(772,'4360','Kirke Eskilstrup'),(773,'4370','Store Merløse'),(774,'4390','Vipperød'),(775,'4400','Kalundborg'),(776,'4420','Regstrup'),(777,'4440','Mørkøv'),(778,'4450','Jyderup'),(779,'4460','Snertinge'),(780,'4470','Svebølle'),(781,'4480','Store Fuglede'),(782,'4490','Jerslev Sjælland'),(783,'4500','Nykøbing Sj'),(784,'4520','Svinninge'),(785,'4532','Gislinge'),(786,'4534','Hørve'),(787,'4540','Fårevejle'),(788,'4550','Asnæs'),(789,'4560','Vig'),(790,'4571','Grevinge'),(791,'4572','Nørre Asmindrup'),(792,'4573','Højby'),(793,'4581','Rørvig'),(794,'4583','Sjællands Odde'),(795,'4591','Føllenslev'),(796,'4592','Sejerø'),(797,'4593','Eskebjerg'),(798,'4600','Køge'),(799,'4621','Gadstrup'),(800,'4622','Havdrup'),(801,'4623','Lille Skensved'),(802,'4632','Bjæverskov'),(803,'4640','Faxe'),(804,'4652','Hårlev'),(805,'4653','Karise'),(806,'4654','Faxe Ladeplads'),(807,'4660','Store Heddinge'),(808,'4671','Strøby'),(809,'4672','Klippinge'),(810,'4673','Rødvig Stevns'),(811,'4681','Herfølge'),(812,'4682','Tureby'),(813,'4683','Rønnede'),(814,'4684','Holmegaard'),(815,'4690','Haslev'),(816,'4700','Næstved'),(817,'4720','Præstø'),(818,'4733','Tappernøje'),(819,'4735','Mern'),(820,'4736','Karrebæksminde'),(821,'4750','Lundby'),(822,'4760','Vordingborg'),(823,'4771','Kalvehave'),(824,'4772','Langebæk'),(825,'4773','Stensved'),(826,'4780','Stege'),(827,'4791','Borre'),(828,'4792','Askeby'),(829,'4793','Bogø By'),(830,'4800','Nykøbing F'),(831,'4840','Nørre Alslev'),(832,'4850','Stubbekøbing'),(833,'4862','Guldborg'),(834,'4863','Eskilstrup'),(835,'4871','Horbelev'),(836,'4872','Idestrup'),(837,'4873','Væggerløse'),(838,'4874','Gedser'),(839,'4880','Nysted'),(840,'4891','Toreby L'),(841,'4892','Kettinge'),(842,'4894','Øster Ulslev'),(843,'4895','Errindlev'),(844,'4900','Nakskov'),(845,'4912','Harpelunde'),(846,'4913','Horslunde'),(847,'4920','Søllested'),(848,'4930','Maribo'),(849,'4941','Bandholm'),(850,'4943','Torrig L'),(851,'4944','Fejø'),(852,'4951','Nørreballe'),(853,'4952','Stokkemarke'),(854,'4953','Vesterborg'),(855,'4960','Holeby'),(856,'4970','Rødby'),(857,'4983','Dannemare'),(858,'4990','Sakskøbing'),(859,'5000','Odense C'),(860,'5029','Odense C'),(861,'5100','Odense C'),(862,'5200','Odense V'),(863,'5210','Odense NV'),(864,'5220','Odense SØ'),(865,'5230','Odense M'),(866,'5240','Odense NØ'),(867,'5250','Odense SV'),(868,'5260','Odense S'),(869,'5270','Odense N'),(870,'5290','Marslev'),(871,'5300','Kerteminde'),(872,'5320','Agedrup'),(873,'5330','Munkebo'),(874,'5350','Rynkeby'),(875,'5370','Mesinge'),(876,'5380','Dalby'),(877,'5390','Martofte'),(878,'5400','Bogense'),(879,'5450','Otterup'),(880,'5462','Morud'),(881,'5463','Harndrup'),(882,'5464','Brenderup Fyn'),(883,'5466','Asperup'),(884,'5471','Søndersø'),(885,'5474','Veflinge'),(886,'5485','Skamby'),(887,'5491','Blommenslyst'),(888,'5492','Vissenbjerg'),(889,'5500','Middelfart'),(890,'5540','Ullerslev'),(891,'5550','Langeskov'),(892,'5560','Aarup'),(893,'5580','Nørre Aaby'),(894,'5591','Gelsted'),(895,'5592','Ejby'),(896,'5600','Faaborg'),(897,'5610','Assens'),(898,'5620','Glamsbjerg'),(899,'5631','Ebberup'),(900,'5642','Millinge'),(901,'5672','Broby'),(902,'5683','Haarby'),(903,'5690','Tommerup'),(904,'5700','Svendborg'),(905,'5750','Ringe'),(906,'5762','Vester Skerninge'),(907,'5771','Stenstrup'),(908,'5772','Kværndrup'),(909,'5792','Årslev'),(910,'5800','Nyborg'),(911,'5853','Ørbæk'),(912,'5854','Gislev'),(913,'5856','Ryslinge'),(914,'5863','Ferritslev Fyn'),(915,'5871','Frørup'),(916,'5874','Hesselager'),(917,'5881','Skårup Fyn'),(918,'5882','Vejstrup'),(919,'5883','Oure'),(920,'5884','Gudme'),(921,'5892','Gudbjerg Sydfyn'),(922,'5900','Rudkøbing'),(923,'5932','Humble'),(924,'5935','Bagenkop'),(925,'5953','Tranekær'),(926,'5960','Marstal'),(927,'5970','Ærøskøbing'),(928,'5985','Søby Ærø'),(929,'6000','Kolding'),(930,'6040','Egtved'),(931,'6051','Almind'),(932,'6052','Viuf'),(933,'6064','Jordrup'),(934,'6070','Christiansfeld'),(935,'6091','Bjert'),(936,'6092','Sønder Stenderup'),(937,'6093','Sjølund'),(938,'6094','Hejls'),(939,'6100','Haderslev'),(940,'6200','Aabenraa'),(941,'6230','Rødekro'),(942,'6240','Løgumkloster'),(943,'6261','Bredebro'),(944,'6270','Tønder'),(945,'6280','Højer'),(946,'6300','Gråsten'),(947,'6310','Broager'),(948,'6320','Egernsund'),(949,'6330','Padborg'),(950,'6340','Kruså'),(951,'6360','Tinglev'),(952,'6372','Bylderup-Bov'),(953,'6392','Bolderslev'),(954,'6400','Sønderborg'),(955,'6430','Nordborg'),(956,'6440','Augustenborg'),(957,'6470','Sydals'),(958,'6500','Vojens'),(959,'6510','Gram'),(960,'6520','Toftlund'),(961,'6534','Agerskov'),(962,'6535','Branderup J'),(963,'6541','Bevtoft'),(964,'6560','Sommersted'),(965,'6580','Vamdrup'),(966,'6600','Vejen'),(967,'6621','Gesten'),(968,'6622','Bække'),(969,'6623','Vorbasse'),(970,'6630','Rødding'),(971,'6640','Lunderskov'),(972,'6650','Brørup'),(973,'6660','Lintrup'),(974,'6670','Holsted'),(975,'6682','Hovborg'),(976,'6683','Føvling'),(977,'6690','Gørding'),(978,'6700','Esbjerg'),(979,'6701','Esbjerg'),(980,'6705','Esbjerg Ø'),(981,'6710','Esbjerg V'),(982,'6715','Esbjerg N'),(983,'6720','Fanø'),(984,'6731','Tjæreborg'),(985,'6740','Bramming'),(986,'6752','Glejbjerg'),(987,'6753','Agerbæk'),(988,'6760','Ribe'),(989,'6771','Gredstedbro'),(990,'6780','Skærbæk'),(991,'6792','Rømø'),(992,'6800','Varde'),(993,'6818','Årre'),(994,'6823','Ansager'),(995,'6830','Nørre Nebel'),(996,'6840','Oksbøl'),(997,'6851','Janderup Vestj'),(998,'6852','Billum'),(999,'6853','Vejers Strand'),(1000,'6854','Henne'),(1001,'6855','Outrup'),(1002,'6857','Blåvand'),(1003,'6862','Tistrup'),(1004,'6870','Ølgod'),(1005,'6880','Tarm'),(1006,'6893','Hemmet'),(1007,'6900','Skjern'),(1008,'6920','Videbæk'),(1009,'6933','Kibæk'),(1010,'6940','Lem St'),(1011,'6950','Ringkøbing'),(1012,'6960','Hvide Sande'),(1013,'6971','Spjald'),(1014,'6973','Ørnhøj'),(1015,'6980','Tim'),(1016,'6990','Ulfborg'),(1017,'7000','Fredericia'),(1018,'7007','Fredericia'),(1019,'7029','Fredericia'),(1020,'7080','Børkop'),(1021,'7100','Vejle'),(1022,'7120','Vejle Øst'),(1023,'7130','Juelsminde'),(1024,'7140','Stouby'),(1025,'7150','Barrit'),(1026,'7160','Tørring'),(1027,'7171','Uldum'),(1028,'7173','Vonge'),(1029,'7182','Bredsten'),(1030,'7183','Randbøl'),(1031,'7184','Vandel'),(1032,'7190','Billund'),(1033,'7200','Grindsted'),(1034,'7250','Hejnsvig'),(1035,'7260','Sønder Omme'),(1036,'7270','Stakroge'),(1037,'7280','Sønder Felding'),(1038,'7300','Jelling'),(1039,'7321','Gadbjerg'),(1040,'7323','Give'),(1041,'7330','Brande'),(1042,'7361','Ejstrupholm'),(1043,'7362','Hampen'),(1044,'7400','Herning'),(1045,'7429','Herning'),(1046,'7430','Ikast'),(1047,'7441','Bording'),(1048,'7442','Engesvang'),(1049,'7451','Sunds'),(1050,'7470','Karup J'),(1051,'7480','Vildbjerg'),(1052,'7490','Aulum'),(1053,'7500','Holstebro'),(1054,'7540','Haderup'),(1055,'7550','Sørvad'),(1056,'7560','Hjerm'),(1057,'7570','Vemb'),(1058,'7600','Struer'),(1059,'7620','Lemvig'),(1060,'7650','Bøvlingbjerg'),(1061,'7660','Bækmarksbro'),(1062,'7673','Harboøre'),(1063,'7680','Thyborøn'),(1064,'7700','Thisted'),(1065,'7730','Hanstholm'),(1066,'7741','Frøstrup'),(1067,'7742','Vesløs'),(1068,'7752','Snedsted'),(1069,'7755','Bedsted Thy'),(1070,'7760','Hurup Thy'),(1071,'7770','Vestervig'),(1072,'7790','Thyholm'),(1073,'7800','Skive'),(1074,'7830','Vinderup'),(1075,'7840','Højslev'),(1076,'7850','Stoholm Jyll'),(1077,'7860','Spøttrup'),(1078,'7870','Roslev'),(1079,'7884','Fur'),(1080,'7900','Nykøbing M'),(1081,'7950','Erslev'),(1082,'7960','Karby'),(1083,'7970','Redsted M'),(1084,'7980','Vils'),(1085,'7990','Øster Assels'),(1086,'7999','Kommunepost'),(1087,'8000','Århus C'),(1088,'8100','Århus C'),(1089,'8200','Århus N'),(1090,'8210','Århus V'),(1091,'8220','Brabrand'),(1092,'8229','Risskov Ø'),(1093,'8230','Åbyhøj'),(1094,'8240','Risskov'),(1095,'8245','Risskov Ø'),(1096,'8250','Egå'),(1097,'8260','Viby J'),(1098,'8270','Højbjerg'),(1099,'8300','Odder'),(1100,'8305','Samsø'),(1101,'8310','Tranbjerg J'),(1102,'8320','Mårslet'),(1103,'8330','Beder'),(1104,'8340','Malling'),(1105,'8350','Hundslund'),(1106,'8355','Solbjerg'),(1107,'8361','Hasselager'),(1108,'8362','Hørning'),(1109,'8370','Hadsten'),(1110,'8380','Trige'),(1111,'8381','Tilst'),(1112,'8382','Hinnerup'),(1113,'8400','Ebeltoft'),(1114,'8410','Rønde'),(1115,'8420','Knebel'),(1116,'8444','Balle'),(1117,'8450','Hammel'),(1118,'8462','Harlev J'),(1119,'8464','Galten'),(1120,'8471','Sabro'),(1121,'8472','Sporup'),(1122,'8500','Grenaa'),(1123,'8520','Lystrup'),(1124,'8530','Hjortshøj'),(1125,'8541','Skødstrup'),(1126,'8543','Hornslet'),(1127,'8544','Mørke'),(1128,'8550','Ryomgård'),(1129,'8560','Kolind'),(1130,'8570','Trustrup'),(1131,'8581','Nimtofte'),(1132,'8585','Glesborg'),(1133,'8586','Ørum Djurs'),(1134,'8592','Anholt'),(1135,'8600','Silkeborg'),(1136,'8620','Kjellerup'),(1137,'8632','Lemming'),(1138,'8641','Sorring'),(1139,'8643','Ans By'),(1140,'8653','Them'),(1141,'8654','Bryrup'),(1142,'8660','Skanderborg'),(1143,'8670','Låsby'),(1144,'8680','Ry'),(1145,'8700','Horsens'),(1146,'8721','Daugård'),(1147,'8722','Hedensted'),(1148,'8723','Løsning'),(1149,'8732','Hovedgård'),(1150,'8740','Brædstrup'),(1151,'8751','Gedved'),(1152,'8752','Østbirk'),(1153,'8762','Flemming'),(1154,'8763','Rask Mølle'),(1155,'8765','Klovborg'),(1156,'8766','Nørre Snede'),(1157,'8781','Stenderup'),(1158,'8783','Hornsyld'),(1159,'8800','Viborg'),(1160,'8830','Tjele'),(1161,'8831','Løgstrup'),(1162,'8832','Skals'),(1163,'8840','Rødkærsbro'),(1164,'8850','Bjerringbro'),(1165,'8860','Ulstrup'),(1166,'8870','Langå'),(1167,'8881','Thorsø'),(1168,'8882','Fårvang'),(1169,'8883','Gjern'),(1170,'8900','Randers C'),(1171,'8920','Randers NV'),(1172,'8930','Randers NØ'),(1173,'8940','Randers SV'),(1174,'8950','Ørsted'),(1175,'8960','Randers SØ'),(1176,'8961','Allingåbro'),(1177,'8963','Auning'),(1178,'8970','Havndal'),(1179,'8981','Spentrup'),(1180,'8983','Gjerlev J'),(1181,'8990','Fårup'),(1182,'9000','Aalborg'),(1183,'9029','Aalborg'),(1184,'9100','Aalborg'),(1185,'9200','Aalborg SV'),(1186,'9210','Aalborg SØ'),(1187,'9220','Aalborg Øst'),(1188,'9230','Svenstrup J'),(1189,'9240','Nibe'),(1190,'9260','Gistrup'),(1191,'9270','Klarup'),(1192,'9280','Storvorde'),(1193,'9293','Kongerslev'),(1194,'9300','Sæby'),(1195,'9310','Vodskov'),(1196,'9320','Hjallerup'),(1197,'9330','Dronninglund'),(1198,'9340','Asaa'),(1199,'9352','Dybvad'),(1200,'9362','Gandrup'),(1201,'9370','Hals'),(1202,'9380','Vestbjerg'),(1203,'9381','Sulsted'),(1204,'9382','Tylstrup'),(1205,'9400','Nørresundby'),(1206,'9430','Vadum'),(1207,'9440','Aabybro'),(1208,'9460','Brovst'),(1209,'9480','Løkken'),(1210,'9490','Pandrup'),(1211,'9492','Blokhus'),(1212,'9493','Saltum'),(1213,'9500','Hobro'),(1214,'9510','Arden'),(1215,'9520','Skørping'),(1216,'9530','Støvring'),(1217,'9541','Suldrup'),(1218,'9550','Mariager'),(1219,'9560','Hadsund'),(1220,'9574','Bælum'),(1221,'9575','Terndrup'),(1222,'9600','Aars'),(1223,'9610','Nørager'),(1224,'9620','Aalestrup'),(1225,'9631','Gedsted'),(1226,'9632','Møldrup'),(1227,'9640','Farsø'),(1228,'9670','Løgstør'),(1229,'9681','Ranum'),(1230,'9690','Fjerritslev'),(1231,'9700','Brønderslev'),(1232,'9740','Jerslev J'),(1233,'9750','Østervrå'),(1234,'9760','Vrå'),(1235,'9800','Hjørring'),(1236,'9830','Tårs'),(1237,'9850','Hirtshals'),(1238,'9870','Sindal'),(1239,'9881','Bindslev'),(1240,'9900','Frederikshavn'),(1241,'9940','Læsø'),(1242,'9970','Strandby'),(1243,'9981','Jerup'),(1244,'9982','Ålbæk'),(1245,'9990','Skagen');

/*Table structure for table `slideshow` */

DROP TABLE IF EXISTS `slideshow`;

CREATE TABLE `slideshow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `alias` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `link_path` varchar(255) NOT NULL,
  `publish` tinyint(4) NOT NULL,
  `ordering` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `slideshow` */

insert  into `slideshow`(`id`,`title`,`alias`,`image`,`link_path`,`publish`,`ordering`) values (3,'Image 1','image-1','96b1d8ec52bb22a52b1604358bf8d3c7.jpg','http://localhost/sugardating/index.php/articles/view/18/test-slideshow.html',1,1),(4,'Image 2','image-2','57c0f779a363c2cdfd8b3a261d089237.jpg','',1,2),(5,'Image 3','image-3','70e4ee1ee592092f973ea86b1fb6c724.jpg','',1,3),(6,'Image 4','image-4','2b1f4fecd5e8629d89e0ba88e55af806.jpg','',1,4);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `day` varchar(10) NOT NULL,
  `month` varchar(10) NOT NULL,
  `year` varchar(10) NOT NULL,
  `height` int(10) NOT NULL,
  `weight` int(10) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `hide_avatar` tinyint(4) NOT NULL,
  `code` varchar(100) NOT NULL,
  `city` varchar(255) NOT NULL,
  `own` int(11) NOT NULL,
  `play` int(11) NOT NULL,
  `member` tinyint(4) NOT NULL,
  `payment_time` int(11) NOT NULL,
  `facebook_id` varchar(50) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `register_time` int(11) NOT NULL,
  `last_login` int(11) NOT NULL DEFAULT '0',
  `verify_code` varchar(255) NOT NULL,
  `status` text NOT NULL,
  `status_permission` tinyint(4) NOT NULL,
  `description` text NOT NULL,
  `slogan` text NOT NULL,
  `see_profile` tinyint(4) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `publish` tinyint(4) NOT NULL,
  `ordering` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1031 DEFAULT CHARSET=utf8;

/*Data for the table `user` */

insert  into `user`(`id`,`email`,`password`,`name`,`gender`,`day`,`month`,`year`,`height`,`weight`,`phone`,`hide_avatar`,`code`,`city`,`own`,`play`,`member`,`payment_time`,`facebook_id`,`avatar`,`register_time`,`last_login`,`verify_code`,`status`,`status_permission`,`description`,`slogan`,`see_profile`,`active`,`publish`,`ordering`) values (1014,'nttrung211@gmail.com','e10adc3949ba59abbe56e057f20f883e','Trung',1,'21','11','1986',123,123,'123456789123',0,'1233','Testby',3,2,2,0,'0','d4360afcc11b678b2e00875d4b00bbb7.jpeg',1381315741,1395716209,'a5173dad2be2de5b4fffcbf2d40a6556','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum molestie euismod. ',1,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum molestie euismod. Vestibulum quis odio eu sem interdum sagittis. Phasellus vitae rhoncus turpis. Mauris ut commodo lacus. Suspendisse in tortor tincidunt, accumsan diam eget, vestibulum erat. Suspendisse vulputate mi dui, non semper nisl sodales non. Praesent felis est, euismod a posuere mattis, hendrerit at nisl. Phasellus augue ante, lacinia bibendum velit at, faucibus consequat risus. Nulla ut ligula nec mauris dignissim vehicula quis ac nibh. Nullam non urna eros. Curabitur nec augue faucibus, mollis elit ac, euismod mi. ','',1,1,1,0),(1017,'nguyen.cuong@mwc.vn','1bbd886460827015e5d605ed44252251','Cuong Cuong',1,'2','2','1985',170,60,'123123123',0,'9999','',1,3,2,1412129384,'0','4fd92d3985e31e6617bed8bb7ce6c258.jpg',1385525966,1413941840,'43248f02e45da2a79d6b5e4b67a6321e','Cuong Dola Hehehe',1,'Mo ta chi tiet chắc','Khong biet no la gi',1,1,1,0),(1018,'Christina@reddocksmedia.com','53f637ea05841a29f6ebc58be4ffff74','Sugardating',0,'5','5','1908',188,60,'123456789',0,'1200','Zebraby',1,1,1,0,'0',NULL,1386895814,1386896179,'6ec9b184895d62f26d6c61b55ce11a11','',0,'','',1,1,1,0),(1019,'thanh.trung@mwc.vn','e10adc3949ba59abbe56e057f20f883e','Tester 1',1,'6','8','1989',123,123,'0090909090',0,'1233','Test city',1,4,1,1388032039,'0',NULL,1388032014,0,'27b71c56beefce2101bfbf2061b2b82a','',0,'','',1,1,1,0),(1027,'gold@mwc.vn','1bbd886460827015e5d605ed44252251','Check gold',0,'1','1','1914',0,0,'',0,'','',1,1,1,0,'0',NULL,1409300808,0,'8304ea4512fe47972defe31c278dbec2','',0,'','',1,1,1,0),(1023,'cuongle@yahoo.com','1bbd886460827015e5d605ed44252251','Cuong Le La Cai Ten',1,'11','6','1985',0,0,'',0,'1234','HCM',2,1,2,1413944471,'0',NULL,1396487721,1413969838,'ef42e35e7bc0948f72f90e623d558bfb','',1,'d asdasd asdasdasd','asd dasdasd',1,1,1,0),(1024,'cuongcuong1@yahoo.com','1bbd886460827015e5d605ed44252251','cuongcuong',1,'16','5','1985',0,0,'',1,'1234','HCM',1,4,2,0,'0',NULL,1398051829,1406532063,'4128e54af2eeaa8937d9ffd2c21569f3','',1,'','',1,1,1,0);

/*Table structure for table `viewprofile` */

DROP TABLE IF EXISTS `viewprofile`;

CREATE TABLE `viewprofile` (
  `int` int(11) NOT NULL AUTO_INCREMENT,
  `fromid` int(11) DEFAULT NULL,
  `toid` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  PRIMARY KEY (`int`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `viewprofile` */

/*Table structure for table `wish_list` */

DROP TABLE IF EXISTS `wish_list`;

CREATE TABLE `wish_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `deal_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `wish_list` */

insert  into `wish_list`(`id`,`user_id`,`deal_id`) values (4,1017,5),(6,1017,6),(5,1017,7),(7,1023,3),(8,1023,5),(9,1023,6);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
