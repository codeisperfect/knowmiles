<?php
include "includes/app.php";

$olaloc=array(1=>"Andheri West",2=>"Andheri East",3=>"Jogeshwari East",4=>"Jogeshwari West",5=>"Santacruz East",6=>"Santacruz West",7=>"Juhu",8=>"Vile Parle West",9=>"Vile Parle East",10=>"Bandra East",11=>"Bandra West",12=>"Dadar East",13=>"Dadar West",14=>"Sion East",15=>"Sion West",16=>"Mahim",17=>"Khar East",18=>"Khar West",19=>"Matunga East",20=>"Matunga West",21=>"Worli",22=>"Lower Parel",23=>"Parel",24=>"Chinchpokli",25=>"Borivali East",26=>"Borivali West",27=>"Bhayander East",28=>"Bhayander West",29=>"Dahisar East",30=>"Dahisar West",31=>"Mira Road",32=>"Charni Road",33=>"Nariman Point",34=>"Colaba",35=>"Fort",36=>"Churchgate",37=>"Marine Lines",38=>"New Marine Lines",39=>"CST (VT)",40=>"Wadala East",41=>"Malabar Hill",42=>"Wadala West",43=>"Cotton Green",44=>"Mumbai Central",45=>"Grant Road",46=>"Sandhurst Road",47=>"Cumballa Hill",48=>"Prabhadevi",49=>"Cuffe Parade",50=>"Breach Candy",51=>"Marine Drive",52=>"Masjid Bunder",53=>"Byculla East",54=>"Byculla West",55=>"Chunabhatti",56=>"Kurla West",57=>"Chembur East",58=>"Chembur West",59=>"Ghatkopar East",60=>"Ghatkopar West",61=>"Sewri",62=>"Mankhurd",63=>"Kurla East",64=>"Trombay",65=>"Govandi",66=>"Kandivali East",67=>"Kandivali West",68=>"Malad East",69=>"Malad West",70=>"Goregaon East",71=>"Goregaon West",72=>"CBD Belapur",73=>"Sea Woods",74=>"Airoli",75=>"New Panvel",76=>"Vashi",77=>"Bhandup East",78=>"Bhandup West",79=>"Vikhroli West",80=>"Vikhroli East",81=>"Kanjurg Marg East",82=>"Kanjurg Marg West",83=>"Mulund East",84=>"Mulund West",85=>"Bhuleshwar",86=>"Powai",87=>"Thane East",88=>"Thane West",1322=>"Domestic Airport",1323=>"International Airport",1324=>"Mahalakshmi",1624=>"Grant Road East",1625=>"Grant Road West",1626=>"Mahalaxmi East",1627=>"Mahalaxmi West",1628=>"Masjid Bunder East",1629=>"Masjid Bunder West",1630=>"Sandhurst Road East",1631=>"Sandhurst Road West",1632=>"Dockyard Road",1633=>"Raey Road",1634=>"Mahim East",1635=>"Mahim West",1636=>"Chinchpokli East",1637=>"Chinchpokli West",1638=>"Currey Road East",1639=>"Currey Road West",1640=>"Elphinstone Road East",1641=>"Elphinstone Road West",1642=>"King Circle East",1643=>"King Circle West",1644=>"Vidyavihar East",1645=>"Vidyavihar West",1646=>"Sanpada",1647=>"Juinagar",1648=>"Nerul",1649=>"Kharghar",1650=>"Turbhe",1651=>"Koparkhairane",1652=>"Ghansoli",1653=>"Rabale",1654=>"Charni Road East",1655=>"Marine Lines West",1656=>"Marine Lines East",1657=>"Mumbai Central West",1658=>"Masjid Bander West",1659=>"CST",1660=>"Masjid Bandar East",1661=>"Andjeri West",1662=>"Bhayandar East",1663=>"Kanjurmarg East",1664=>"Vikroli West",1665=>"Vikroli East",1666=>"Chembur",1667=>"Kalwa",1668=>"Kooparkhariane",1669=>"Kamothe",1670=>"Govandi East",1671=>"Kopar Khairane",1673=>"Byculla",1781=>"Custom locality",24100=>"Aarey Road",24101=>"Agashi",24102=>"Agripada",24103=>"Alibag",24104=>"Altamount Road",24105=>"Ambernath",24106=>"Ambivali",24107=>"Amboli",24108=>"Andheri-Kurla Road",24109=>"Anushakti Nagar",24110=>"Asangaon",24111=>"Atgaon",24112=>"Azad Nagar",24113=>"Badlapur East",24114=>"Badlapur West",24115=>"Bandra Kurla Complex",24116=>"Bangur Nagar",24117=>"Behram Baug",24118=>"Beverly Park",24119=>"Bhadane",24120=>"Bhayandar West",24121=>"Bhivpuri",24122=>"Bhiwandi",24123=>"Boisar",24124=>"C.P. Tank",24125=>"Carter Road",24126=>"Chakala",24127=>"Chandivali",24128=>"Charkop",24129=>"Chedda Nagar",24130=>"Chikuwadi",24131=>"Chinchpada",24132=>"Chiplun",24133=>"Chira Bazar",24134=>"Chuna Bhatti",24135=>"Currey Road",24136=>"Dahanu",24137=>"Dahanu Road",24138=>"Deonar",24139=>"Dharavi",24140=>"Dindoshi",24141=>"Dombivli East",24142=>"Dombivli West",24143=>"Dongri",24144=>"Elphinstone Road",24145=>"Evershine Nagar",24146=>"G T B Nagar",24147=>"Gaibi Nagar",24148=>"Gamdevi",24149=>"Gandhi Nagar",24150=>"Ghera Sudhagad",24151=>"Girgaon",24152=>"Gokuldam",24153=>"Golibar",24154=>"Gorai",24155=>"Govind Nagar",24156=>"Gulmohar Road",24157=>"Haji Ali",24158=>"Harihareshwar",24159=>"Ic Colony",24160=>"J B Nagar",24161=>"Jacob Circle",24162=>"Jawhar",24163=>"Juhu Tara Road",24164=>"Kalbadevi",24165=>"Kalher",24166=>"Kalina",24167=>"Kalyan East",24168=>"Kalyan West",24169=>"Kalyan-Shil Road",24170=>"Kamatghar",24171=>"Kanakia Road",24172=>"Kanjurmarg",24173=>"Kanti Park",24174=>"Karjat",24175=>"Kasara",24176=>"Kashimira",24177=>"Kemps Corner",24178=>"Khadakpada",24179=>"Khan Abdul Gafar Road",24180=>"Khandale",24181=>"Khandas Road",24182=>"Khardi",24183=>"Kharodi",24184=>"Khetwadi",24185=>"Khodala",24186=>"Khopoli",24187=>"Kolad",24188=>"Lal Baug",24189=>"Lbs Marg",24190=>"Link Road",24191=>"Linking Road",24192=>"Lokhandwala",24193=>"Lonere",24194=>"Madh Island",24195=>"Mahad",24196=>"Mahalaxmi",24197=>"Mahavir Nagar",24198=>"Malvani",24199=>"Mandapeshwar",24200=>"Mandvi",24201=>"Mangaon",24202=>"Manori",24203=>"Marol",24204=>"Mazgaon",24205=>"Mhada Colony",24206=>"Mira Bhayandar",24207=>"Mumbai - Nasik Highway",24208=>"Murbad",24209=>"Murbad Karjat Road",24210=>"Murbad Road",24211=>"Murud",24212=>"Nagothane",24213=>"Nagpada",24214=>"Nahur East",24215=>"Nahur West",24216=>"Naigaon East",24217=>"Naigaon West",24218=>"Nalasopara East",24219=>"Nalasopara West",24220=>"Narayan Patil Wadi",24221=>"Navapada",24222=>"Navghar Road",24223=>"Naya Nagar",24224=>"Nehru Nagar",24225=>"Nehru Road",24226=>"Neral",24227=>"Opera House",24228=>"Orlem Malad",24229=>"Oshiwara",24230=>"Palghar",24231=>"Pali",24232=>"Pali Hill",24233=>"Peddar Road",24234=>"Poonam Nagar",24235=>"Prabhu Ali",24236=>"Pydhonie",24237=>"Raigad",24238=>"Ramnagar",24239=>"Roha",24240=>"Royal Palms",24241=>"S V Road",24242=>"Sahar",24243=>"Sakinaka",24244=>"Samat Nagar",24245=>"Saralgoan",24246=>"Saravali",24247=>"Sarvodaya Nagar",24248=>"Senapati Bapat Marg",24249=>"Shahad",24250=>"Shahapur",24251=>"Shastri Nagar",24252=>"Shivaji Nagar",24253=>"Shivaji Park",24254=>"Sir Jj Road",24255=>"Talasari",24256=>"Tardeo",24257=>"Thakurdwar",24258=>"Thakurli",24259=>"Tilak Nagar",24260=>"Titwala",24261=>"Triveni Nagar",24262=>"Tulsiwadi",24263=>"Ulhasnagar",24264=>"Umerkhadi",24265=>"Upper Parel",24266=>"Upper Worli",24267=>"Uttan",24268=>"V P Road",24269=>"Vakola",24270=>"Vangani",24271=>"Vasai East",24272=>"Vasai Road",24273=>"Vasai West",24274=>"Vasai-Nallasopara Link Road",24275=>"Vasind",24276=>"Veera Desai Road",24277=>"Versova",24278=>"Vidya Nagari",24279=>"Vidyavihar",24280=>"Vijay Nagar",24281=>"Vikramgad",24282=>"Virar East",24283=>"Virar West",24284=>"Vitthalwadi",24285=>"Wada",24286=>"Walkeshwar",24287=>"Warden Road",24288=>"Western Express Highway",24289=>"Yari Road",24290=>"Yogi Jawraj Nagar",24291=>"Zadghar",<option=>"",1=>"Andheri West",2=>"Andheri East",3=>"Jogeshwari East",4=>"Jogeshwari West",5=>"Santacruz East",6=>"Santacruz West",7=>"Juhu",8=>"Vile Parle West",9=>"Vile Parle East",10=>"Bandra East",11=>"Bandra West",12=>"Dadar East",13=>"Dadar West",14=>"Sion East",15=>"Sion West",16=>"Mahim",17=>"Khar East",18=>"Khar West",19=>"Matunga East",20=>"Matunga West",21=>"Worli",22=>"Lower Parel",23=>"Parel",24=>"Chinchpokli",25=>"Borivali East",26=>"Borivali West",27=>"Bhayander East",28=>"Bhayander West",29=>"Dahisar East",30=>"Dahisar West",31=>"Mira Road",32=>"Charni Road",33=>"Nariman Point",34=>"Colaba",35=>"Fort",36=>"Churchgate",37=>"Marine Lines",38=>"New Marine Lines",39=>"CST (VT)",40=>"Wadala East",41=>"Malabar Hill",42=>"Wadala West",43=>"Cotton Green",44=>"Mumbai Central",45=>"Grant Road",46=>"Sandhurst Road",47=>"Cumballa Hill",48=>"Prabhadevi",49=>"Cuffe Parade",50=>"Breach Candy",51=>"Marine Drive",52=>"Masjid Bunder",53=>"Byculla East",54=>"Byculla West",55=>"Chunabhatti",56=>"Kurla West",57=>"Chembur East",58=>"Chembur West",59=>"Ghatkopar East",60=>"Ghatkopar West",61=>"Sewri",62=>"Mankhurd",63=>"Kurla East",64=>"Trombay",65=>"Govandi",66=>"Kandivali East",67=>"Kandivali West",68=>"Malad East",69=>"Malad West",70=>"Goregaon East",71=>"Goregaon West",72=>"CBD Belapur",73=>"Sea Woods",74=>"Airoli",75=>"New Panvel",76=>"Vashi",77=>"Bhandup East",78=>"Bhandup West",79=>"Vikhroli West",80=>"Vikhroli East",81=>"Kanjurg Marg East",82=>"Kanjurg Marg West",83=>"Mulund East",84=>"Mulund West",85=>"Bhuleshwar",86=>"Powai",87=>"Thane East",88=>"Thane West",1322=>"Domestic Airport",1323=>"International Airport",1324=>"Mahalakshmi",1624=>"Grant Road East",1625=>"Grant Road West",1626=>"Mahalaxmi East",1627=>"Mahalaxmi West",1628=>"Masjid Bunder East",1629=>"Masjid Bunder West",1630=>"Sandhurst Road East",1631=>"Sandhurst Road West",1632=>"Dockyard Road",1633=>"Raey Road",1634=>"Mahim East",1635=>"Mahim West",1636=>"Chinchpokli East",1637=>"Chinchpokli West",1638=>"Currey Road East",1639=>"Currey Road West",1640=>"Elphinstone Road East",1641=>"Elphinstone Road West",1642=>"King Circle East",1643=>"King Circle West",1644=>"Vidyavihar East",1645=>"Vidyavihar West",1646=>"Sanpada",1647=>"Juinagar",1648=>"Nerul",1649=>"Kharghar",1650=>"Turbhe",1651=>"Koparkhairane",1652=>"Ghansoli",1653=>"Rabale",1654=>"Charni Road East",1655=>"Marine Lines West",1656=>"Marine Lines East",1657=>"Mumbai Central West",1658=>"Masjid Bander West",1659=>"CST",1660=>"Masjid Bandar East",1661=>"Andjeri West",1662=>"Bhayandar East",1663=>"Kanjurmarg East",1664=>"Vikroli West",1665=>"Vikroli East",1666=>"Chembur",1667=>"Kalwa",1668=>"Kooparkhariane",1669=>"Kamothe",1670=>"Govandi East",1671=>"Kopar Khairane",1673=>"Byculla",1781=>"Custom locality",24100=>"Aarey Road",24101=>"Agashi",24102=>"Agripada",24103=>"Alibag",24104=>"Altamount Road",24105=>"Ambernath",24106=>"Ambivali",24107=>"Amboli",24108=>"Andheri-Kurla Road",24109=>"Anushakti Nagar",24110=>"Asangaon",24111=>"Atgaon",24112=>"Azad Nagar",24113=>"Badlapur East",24114=>"Badlapur West",24115=>"Bandra Kurla Complex",24116=>"Bangur Nagar",24117=>"Behram Baug",24118=>"Beverly Park",24119=>"Bhadane",24120=>"Bhayandar West",24121=>"Bhivpuri",24122=>"Bhiwandi",24123=>"Boisar",24124=>"C.P. Tank",24125=>"Carter Road",24126=>"Chakala",24127=>"Chandivali",24128=>"Charkop",24129=>"Chedda Nagar",24130=>"Chikuwadi",24131=>"Chinchpada",24132=>"Chiplun",24133=>"Chira Bazar",24134=>"Chuna Bhatti",24135=>"Currey Road",24136=>"Dahanu",24137=>"Dahanu Road",24138=>"Deonar",24139=>"Dharavi",24140=>"Dindoshi",24141=>"Dombivli East",24142=>"Dombivli West",24143=>"Dongri",24144=>"Elphinstone Road",24145=>"Evershine Nagar",24146=>"G T B Nagar",24147=>"Gaibi Nagar",24148=>"Gamdevi",24149=>"Gandhi Nagar",24150=>"Ghera Sudhagad",24151=>"Girgaon",24152=>"Gokuldam",24153=>"Golibar",24154=>"Gorai",24155=>"Govind Nagar",24156=>"Gulmohar Road",24157=>"Haji Ali",24158=>"Harihareshwar",24159=>"Ic Colony",24160=>"J B Nagar",24161=>"Jacob Circle",24162=>"Jawhar",24163=>"Juhu Tara Road",24164=>"Kalbadevi",24165=>"Kalher",24166=>"Kalina",24167=>"Kalyan East",24168=>"Kalyan West",24169=>"Kalyan-Shil Road",24170=>"Kamatghar",24171=>"Kanakia Road",24172=>"Kanjurmarg",24173=>"Kanti Park",24174=>"Karjat",24175=>"Kasara",24176=>"Kashimira",24177=>"Kemps Corner",24178=>"Khadakpada",24179=>"Khan Abdul Gafar Road",24180=>"Khandale",24181=>"Khandas Road",24182=>"Khardi",24183=>"Kharodi",24184=>"Khetwadi",24185=>"Khodala",24186=>"Khopoli",24187=>"Kolad",24188=>"Lal Baug",24189=>"Lbs Marg",24190=>"Link Road",24191=>"Linking Road",24192=>"Lokhandwala",24193=>"Lonere",24194=>"Madh Island",24195=>"Mahad",24196=>"Mahalaxmi",24197=>"Mahavir Nagar",24198=>"Malvani",24199=>"Mandapeshwar",24200=>"Mandvi",24201=>"Mangaon",24202=>"Manori",24203=>"Marol",24204=>"Mazgaon",24205=>"Mhada Colony",24206=>"Mira Bhayandar",24207=>"Mumbai - Nasik Highway",24208=>"Murbad",24209=>"Murbad Karjat Road",24210=>"Murbad Road",24211=>"Murud",24212=>"Nagothane",24213=>"Nagpada",24214=>"Nahur East",24215=>"Nahur West",24216=>"Naigaon East",24217=>"Naigaon West",24218=>"Nalasopara East",24219=>"Nalasopara West",24220=>"Narayan Patil Wadi",24221=>"Navapada",24222=>"Navghar Road",24223=>"Naya Nagar",24224=>"Nehru Nagar",24225=>"Nehru Road",24226=>"Neral",24227=>"Opera House",24228=>"Orlem Malad",24229=>"Oshiwara",24230=>"Palghar",24231=>"Pali",24232=>"Pali Hill",24233=>"Peddar Road",24234=>"Poonam Nagar",24235=>"Prabhu Ali",24236=>"Pydhonie",24237=>"Raigad",24238=>"Ramnagar",24239=>"Roha",24240=>"Royal Palms",24241=>"S V Road",24242=>"Sahar",24243=>"Sakinaka",24244=>"Samat Nagar",24245=>"Saralgoan",24246=>"Saravali",24247=>"Sarvodaya Nagar",24248=>"Senapati Bapat Marg",24249=>"Shahad",24250=>"Shahapur",24251=>"Shastri Nagar",24252=>"Shivaji Nagar",24253=>"Shivaji Park",24254=>"Sir Jj Road",24255=>"Talasari",24256=>"Tardeo",24257=>"Thakurdwar",24258=>"Thakurli",24259=>"Tilak Nagar",24260=>"Titwala",24261=>"Triveni Nagar",24262=>"Tulsiwadi",24263=>"Ulhasnagar",24264=>"Umerkhadi",24265=>"Upper Parel",24266=>"Upper Worli",24267=>"Uttan",24268=>"V P Road",24269=>"Vakola",24270=>"Vangani",24271=>"Vasai East",24272=>"Vasai Road",24273=>"Vasai West",24274=>"Vasai-Nallasopara Link Road",24275=>"Vasind",24276=>"Veera Desai Road",24277=>"Versova",24278=>"Vidya Nagari",24279=>"Vidyavihar",24280=>"Vijay Nagar",24281=>"Vikramgad",24282=>"Virar East",24283=>"Virar West",24284=>"Vitthalwadi",24285=>"Wada",24286=>"Walkeshwar",24287=>"Warden Road",24288=>"Western Express Highway",24289=>"Yari Road",24290=>"Yogi Jawraj Nagar",24291=>"Zadghar");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
    $loc1=get("from",'Hauz Khas, New Delhi').", ".get("city");
    $loc2=get("to",'Green Park, New Delhi').", ".get("city");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta name="robots" content="noindex,follow" />
    <title>Loading KnowMiles</title>
    <script src="http://maps.google.com/maps?file=api&v=2&key=ABQIAAAA7j_Q-rshuWkc8HyFI4V2HxQYPm-xtd00hTQOC0OXpAMO40FHAxT29dNBGfxqMPq5zwdeiDSHEPL89A" type="text/javascript"></script>
    <!-- According to the Google Maps API Terms of Service you are required display a Google map when using the Google Maps API. see: http://code.google.com/apis/maps/terms.html -->
    <script type="text/javascript">

    var geocoder, location1, location2, gDir;

    function initialize(){
        geocoder = new GClientGeocoder();
        gDir = new GDirections();
        GEvent.addListener(gDir, "load", function() 
								        {
                                            var time="<?php echo get("time"); ?>";
								            var drivingDistanceMiles = gDir.getDistance().meters / 1609.344;
								            var drivingDistanceKilometers = gDir.getDistance().meters / 1000;       
								            //document.getElementById('results').innerHTML = '<strong>Address 1: </strong>' + location1.address + ' (' + location1.lat + ':' + location1.lon + ')<br /><strong>Address 2: </strong>' + location2.address + ' (' + location2.lat + ':' + location2.lon + ')<br /><strong>Driving Distance: </strong>' + f + ' miles (or ' + drivingDistanceKilometers + ' kilometers)';
								            var resul = "fulloc1=" + location1.address + "&loc1lat=" + location1.lat + "&loc1lon=" + location1.lon + "&fulloc2=" + location2.address + "&loc2lat=" + location2.lat + "&loc2lon=" + location2.lon + "&dist=" + drivingDistanceKilometers+"&duration_min="+(gDir.getDuration ().seconds/60)+"&time="+time;
                                            
								            window.parent.location.href = "<?php echo HOST; ?>book.php?" + encodeURI(resul);
								        });
		
    }

    function showLocation() 
	{
		
		var loca1 = "<?php echo $loc1; ?>";
		var loca2 = "<?php echo $loc2; ?>";
        geocoder.getLocations(loca1, function (response) 
		{
            if (!response || response.Status.code != 200)
            {
                alert("Sorry, we were unable to geocode the first address");
            }
            else
            {
                location1 = {lat: response.Placemark[0].Point.coordinates[1], lon: response.Placemark[0].Point.coordinates[0], address: response.Placemark[0].address};
                geocoder.getLocations(loca2, function (response) {
                    if (!response || response.Status.code != 200)
                    {
                        alert("Sorry, we were unable to geocode the second address");
                    }
                    else
                    {
                        location2 = {lat: response.Placemark[0].Point.coordinates[1], lon: response.Placemark[0].Point.coordinates[0], address: response.Placemark[0].address};
                        gDir.load('from: ' + location1.address + ' to: ' + location2.address);
						
                    }
                });
            }
        });
		
		
    }

    </script>
</head>

<body onload="initialize();showLocation(); return false;">

<!--    <form action="#" onsubmit="showLocation(); return false;">
        <p>
            <input type="text" name="address1" value="Address 1" />
            <input type="text" name="address2" value="Address 2" />
            <input type="submit" value="Search" />
        </p>
    </form>-->
    Loading...
    <p id="results"></p>
    


</body>
    
</html>
<?php
closedb();
?>