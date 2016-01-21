<?php

use Illuminate\Database\Seeder;
use LANMS\Page;

class PagesTableSeeder extends Seeder  {

	public function run() {

		Page::create([
			'title' 		=> 'Informasjon',
			'slug' 			=> 'info',
			'content'		=> '
			<h4>Om Downlink DG</h4>
			<p>Downlink DG er et lokalt dataparty som arrangeres hvert år i Gausdal. I 2016 arrangeres Downlink i gymsalen på Gausdal Ungdomsskole fra 1. - 3. mars. Vår visjon er å gjøre det mulig for lokal ungdom som er interessert i spill, datamaskiner og teknologi til å møtes for å utveklse kunnskaper og ikke minst ha det gøy.</p>

			<h4>Reservering av plasser</h4>
			<ul>
				<li>Du må registrere deg på nettsiden vår for å reservere en plass.</li>
				<li>Du kan midlertidig reservere opp til fem plasser i 48 timer.</li>
				<li>Du kan ikke midlertidig reservere mer enn fem plasser til sammen. Om den midlertidige reservasjonen går ut så vil du ikke få muligheten for å reservere enda en plass. Du kan maks reservere fem plasser <strong>til sammen!</strong></li>
				<li>Du har muligheten for å reservere plasser for dine kamerater, men husk det som står ovenfor.</li>
				<li>Du har mulighet for å betale ved døren men da må du ha fyllt ut adressen din i brukerprofilen.</li>
				<li>Hvis du har reservert plass og ikke møter opp, vil regning bli sendt i posten.</li>
			</ul>

			<h4>Billetter</h4>
			<p>Billetter kan kjøpes sikkert på nett, eller betales i døra. Når Downlink nærmer seg, vil du motta et innskjekkingsbevis som du må ta med når du ankommer LANet. Ta også med legitimasjon.</p>

			<h4>Soveplasser</h4>
			<p>Vi har designerte soveplasser for deltagere. Vi anbefaler ikke å sove på din plass.</p>

			<h4>Internett</h4>
			<p>Internetthastigheten er på 500mbit/s og er levert av Eidsiva Bredbånd. Husk å ta med en minst 10 meter lang TP (nettverks) kabel hvis du vil ha garantert internett!</p>

			<h4>Strøm</h4>
			<p>Hver deltager får tildelt ett strømutak, vi ber om at egen strømforgrener medbringes. Strømkrevende utstyr som kjøleskap, mikcrobølgeovner, vannkokere og lignende settes igjen hjemme. Dette vil medføre at strømnettet kan bli overbelastet. Hvis du vil varme mat eller vann, tilbyr vi microbølgeovn og vannkoker ved kiosken.</p>

			<h4>Informasjon til foreldre</h4>
			<p>Downlink er en trygg møteplass for alle. Dette er det fjerde året vi arrangerer Downlink, og har aldri hatt store problemer med deltagere. Området blir bevoktet av personer over 18 år 24/7. Har du noen spørsmål, kan du sende oss en mail på post@downlinkdg.no </p>
			
			<h4>Hvor er vi</h4>
			<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1922.13587423994!2d10.145452!3d61.19956999999999!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x466a91bcbf2586f1%3A0xd4a5fd64d0ca22eb!2sGausdal+ungdomsskole!5e0!3m2!1sno!2sno!4v1423942911175" style="border:0;width:100%;height:300px;" frameborder="0"></iframe>

		',
		'showinmenu'	=> 1,
		]);

		Page::create([
			'title' 		=> 'Regler',
			'slug' 			=> 'rules',
			'content'		=> '
			<ul>
				<li>Alle deltagere må kunne identifisere seg samt vise bilett til alle tider. Vi ber derfor alle om å ta med identifikasjon med bilde. Bankkort, pass, førerkort osv.</li>
				<li>Snusing, røyking og besittelse av alkohol eller narkotiske stoffer er ikke tillat innenfor området Downlink arrangers. Skal du røyke eller snuse, er det designerte plasser for dette.</li>
			</ul>
			<br>
			<h5>Annet</h5>
			<ul>
				<li>Alle forsøk på å komme seg inn i gymsalen utenom designert inngang er strengt forbudt. Våre vakter patruljerer både gymsalen og området rundt 24/7. Om noen skulle komme seg inn uten deltagerarmbånd, vil de bli bortvist fra området.</li>
				<li>Vi tar ikke ansvar for tyveri, men for sjansen for dette skal bli minimal ber vi deg om å sikre dine verdifulle gjenstander. Få sidemannen til å passe på utstyret ditt mens du sover eller er borte fra plassen din. Skulle likevel et tyveri oppstå, ber vi deg anmeldet forholdet ved å kontakte politiet direkte eller via <a href="http://politi.no">politi.no</a></li>
				<li>Ved en eventuell evakuering hvor alle må forlate bygget, ber vi deg gå til nærmeste nødutgang. Ikke ta med datamaskinen din. Hjelp andre med å komme seg ut, og følg alle instruksjoner fra crewet</li>
				<li>Downlink reserveres seg retten til å bortvise deltagere som bestrider vårt reglement eller norsk lov, uten refusjon av billett, reise eller andre utlegg. Om nødvendig vil vi også anmelde forholdet til Politiet.</li>
			</ul>
			',
			'showinmenu'	=> 0,
		]);
		

	}
}