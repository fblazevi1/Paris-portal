-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jun 13, 2021 at 10:36 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vijesti`
--

-- --------------------------------------------------------

--
-- Table structure for table `clanak`
--

CREATE TABLE `clanak` (
  `id` int(11) NOT NULL,
  `datum` varchar(32) COLLATE utf8_croatian_ci NOT NULL,
  `naslov` varchar(100) CHARACTER SET latin2 COLLATE latin2_croatian_ci NOT NULL,
  `sazetak` text CHARACTER SET latin2 COLLATE latin2_croatian_ci NOT NULL,
  `tekst` text CHARACTER SET latin2 COLLATE latin2_croatian_ci NOT NULL,
  `slika` varchar(64) CHARACTER SET latin2 COLLATE latin2_croatian_ci NOT NULL,
  `kategorija` varchar(64) CHARACTER SET latin2 COLLATE latin2_croatian_ci NOT NULL,
  `arhiva` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `clanak`
--

INSERT INTO `clanak` (`id`, `datum`, `naslov`, `sazetak`, `tekst`, `slika`, `kategorija`, `arhiva`) VALUES
(1, '13.06.2021.', 'Tinejdžeri diljem regije tuguju: Voyage i Breskvica su prekinuli', 'Glazbenici se još uvijek nisu oglasili povodom prekida veze, ali su izbrisali sve zajedničke fotografije, što je brojnim fanovima bio znak da se nešto čudno događa\r\n', 'Oni su mladi, talentirani i popularni. Oni su Anđela Ignjatović i Mihajlo Veruović javnosti poznatiji kao Voyage i Breskvica. Na estradnoj sceni pojavili su se 2019. godine, a njihova pjesma Koraci u noći u rekordnom roku skupila je vrtoglavih 30 milijuna pregleda.\r\n\r\nČinjenica da su u vezi dodatno je privukla pozornost, a važili su za jedan od najljepših mladih parova na estradi. No srpski mediji sada pišu kako su Breskvica i Voyage odlučili staviti točku na svoj odnos.\r\n\r\nSada tinejdžeri diljem regije tuguju zbog kraha njihove veze, a na društvenim mrežama ih mole da daju još jednu priliku ljubavi.', 'nebitno_1.jpg', 'LjubavniBrodolomi', 0),
(2, '13.06.2021.', 'Doznali smo detalje razvoda koji je šokirao hrvatsku scenu, Doris je ostala sama s djecom...', 'Još do prije par dana slovili su za jedan od najskladnijih parova na domaćoj sceni, pa je mnoge šokirala vijest da su pred razvodom.', 'Doris Pinčić Rogoznica i Boris Rogoznica uistinu su se razišli. Kako neslužbeno doznajemo, pjevač se prije nekih mjesec dana iselio iz obiteljske kuće koja se nalazi nadomak Zagreba, a HTV-ova voditeljica i glumica ostala je u njoj s djecom.\r\n\r\nJe li to definitivan razlaz ovog dugogodišnjeg para nije poznato, jer se Pinčić Rogoznica jučer nije javljala na pozive, no prema svemu sudeći jest. Inače, od onih koji ih poznaju, malo tko se nije iznenadio kada je čuo vijest o rastavi mladog para, izuzev naravno onih najbližih. To i ne čudi jer su Doris i njezin suprug Boris djelovali uvijek skladno.\r\n\r\nPjevač je svoju suprugu znao pratiti na službenim putovanjima, a često joj je znao svratiti i na set emisija koje je snimala. Također, zbog specifičnosti njihova posla, morali su se dobro potruditi i surađivati kako bi im obiteljski život s dvoje male djece mogao funkcionirati, a pored toga prošle su godine kupili kuću i na jesen se uselili u svoj novi dom, koji su počeli uređivati. Upravo je zato većina ostala zatečena ovom viješću. S obzirom na sve planove, njima sedma godina braka u koju su ušli nije trebala biti zlosretna.', 'nebitno_2.jpg', 'LjubavniBrodolomi', 0),
(9, '13.06.2021.', 'Potres na showbiz sceni: Kim Kardashian predala zahtjev za razvod braka s Kanyeom', 'Reper i reality zvijezda vezu su započeli 2012. godine, prvo dijete su dobili 2013. godine, a vjenčali su se 2014. godine u Italiji', 'Američka medijska ličnost i poduzetnica Kim Kardashian West (40) u petak je predala zahtjev za razvod braka s reperom i modnim dizajnerom Kanyeom Westom (43), piše Associated Press.\r\n\r\nIzvori kažu da je Kardashian West zahtjev predala Vrhovnom sudu u Los Angelesu, sudu koji je nadležan za sve sporove na teritoriju okruga Los Angeles. Izvori su za AP potvrdili da je zahtjev predan, no o njemu nisu mogli ništa javno reći. Sam zahtjev još nije dostupan za pregled.\r\nWestovi su u braku bili šest i pol godina, a imaju četvero djece - North (7), Saint (5), Chicago (3) i Psalm (1). Par se vjenčao 2014. godine u Italiji.\r\nReperu ju je to bio prvi brak, dok je Kardashian West prije bila u braku s glazbenim producentom Damonom Thomasom (od 2000. do 2004.) i košarkašem Krisom Humphriesom (od 2011. do 2013.).\r\n\r\nReper i reality zvijezda vezu su započeli 2012. godine, a prvo su dijete dobili 2013. godine. West je Kardashian zaprosio na praznom stadionu za bejzbol na kojem inače igra momčad San Francisco Giantsa. Par se 24. svibnja 2014. vjenčao u Renesansnoj tvrđavi u Firenci.\r\nVijest o razvodu bračnog para West dolazi nakon što je obitelj Kardashian u rujnu ove godine objavila da se reality emisija \"Keeping Up With The Kardashians\" nakon 14 godina prestaje emitirati.', 'nebitno_3.jpg', 'LjubavniBrodolomi', 0),
(10, '13.06.2021.', 'PALA JE ODLUKA Maja Šuput i suprug Nenad imaju ime za sina', 'Na popisu napokon ostalo JEDNO ime', 'Čini se kao da je tek nedavno obznanila da sa suprugom Nenadom Tatarinovom čeka prvo dijete. Domaća pjevačica Maja Šuput uistinu još sitno odbrojava do dolaska sina. Naime, Maja je u 38. tjednu trudnoće, zbog čega je sada sve spremnija za odlazak u bolnicu. Nedavno je otkrila kako je njezina torba za bolnicu već spremna, a sada je napokon otkrila da su ona i Nenad napokon odabrali ime za prvorođenca. Ipak, ime i dalje ostaje tajna.', 'koga_briga_1.png', 'KogaBriga', 0),
(11, '13.06.2021.', 'Bačić utjelovila sve horoskopske znakove, fanovi se bune: Mani se horoskopa i vjeruj u Boga...', 'Lidiji su ovnovi generali koji pozdravljaju šakom, rakovi se spremaju poletjeti, bikovi su nešto nalik Supermanu, dok vodenjaci nemaju pametnija posla nego stajati s čašom u ruci', 'Majstorica seksi uradaka na Instagramu, Lidija Bačić (35), još jednom je uspjela zaludjeti fanove. Ovaj put učinila je to u plavom grudnjaku, vrućim hlačicama i pozama koje bi trebale predstavljati svaki znak zodijaka, a njezin je kalendar preko noći skupio dvije tisuće lajkova.\r\n- Što ste po Lille horoskopu? - upitala je uz objavu posebnog kalendara.\r\nAko smo dobro iščitali, Lidiji su ovnovi generali koji pozdravljaju šakom, rakovi se spremaju poletjeti, bikovi su nešto nalik Supermanu, dok vodenjaci nemaju pametnija posla nego stajati s čašom vode u ruci.\r\nDok je dio pratitelja, uglavnom muški, poslušno odgovarao na postavljeno pitanje, neki su se i naljutili. \r\n- Viruj u Boga, mani se horoskopa - napisala joj je jedna pratiteljica. ', 'koga_briga_2.png', 'KogaBriga', 0),
(12, '13.06.2021.', 'Nives Ivanišević za mikrofonom radija: Ne mogu i ne želim više', 'Zaposlena je na Narodnom radiju te je objavila fotografiju s posla. Pratitelji na društvenoj mreži poručili su joj da je predivna, a objava je u kratkom roku skupila preko 1000 lajkova\r\n\r\n', 'Supruga proslavljenog tenisača Gorana Ivaniševića (49), Nives Ivanišević, pozirala je na poslu pa je objavila fotografiju na Instagramu.\r\n\r\n- Pusa da ponedjeljak brze prođe, a bome i ova godina - poručila je te je dodala u hashtagovima: - Ne mogu i ne želim više. 2020. godino, odlazi -.Pratitelji na društvenoj mreži poručili su joj da je predivna, a fotografija je u kratkom roku skupila preko 1000 lajkova.\r\n\r\nNives, koja je zaposlena na Narodnom radiju, u rujnu je pozirala s Goranom na plaži pa je objavila fotografije na kojima se ljube. Također, suprugu je tada posvetila emotivan opis.\r\n- Želim da znaš da osjećam pravu radost u svom srcu kad sam u tvojoj blizini. Osjećam se sigurno uz tebe. Zaštićeno. Kao da si štit nada mnom kad si u blizini. S tobom sam potpuno svoja (što je vjerojatno razlog zbog čega sam dosadna) jer više ne nosim cool masku.  Bio si sa mnom dok sam bila bolesna. Kroz moje strahove. Ohrabrio si me i inspirirao da dosegnem više. Puno sam naučila o sebi s tobom - napisala je.\r\n\r\n- Ugledam se na tebe i nastojim se više educirati. Kad smo u zavadi, svađamo se, osjećam se poraženo i tužno, jer znam da smo puno bolji od toga. Želim samo da znaš da si mi bio najbolji dečko. Nisi savršen, ali nikad te ne bi tražila da budeš. Ti i ja radimo. Uklapamo se. Ti si za mene i dalje najcool čovjek na svijetu. Volim te jako. Nikad neću odustati od tebe. Vjerna sam i odana tebi - dodala je.\r\n\r\n\r\n\r\n\r\n', 'koga_briga_3.jpg', 'KogaBriga', 0);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `ime` varchar(32) COLLATE utf8_croatian_ci NOT NULL,
  `prezime` varchar(64) COLLATE utf8_croatian_ci NOT NULL,
  `korisnicko_ime` varchar(64) COLLATE utf8_croatian_ci NOT NULL,
  `lozinka` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `razina` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `ime`, `prezime`, `korisnicko_ime`, `lozinka`, `razina`) VALUES
(1, 'Fakib', 'Jaseričević', 'faki', '$2y$10$WrTK1mdR3yCScfD/HJJ8ruRq5x7sHej5mN3g6/wtFd4SKYhT2jiQy', 0),
(2, 'admin', 'admin', 'admin', '$2y$10$qqezXXmOmK2r.pquK8z/ye0dDCB3HATJAYxDnuzZWlrBEkT1gk4Ey', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clanak`
--
ALTER TABLE `clanak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `korisnickoIme` (`korisnicko_ime`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clanak`
--
ALTER TABLE `clanak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
