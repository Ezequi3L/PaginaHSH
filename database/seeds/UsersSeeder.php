<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      User::create(['email' => "admin@hsh.com",'email_verified_at' => now(),'password' => bcrypt('admin'),'remember_token' => Str::random(10),'tipo_de_usuario' => 0]);
      User::create(['name' => "Usuario Premium",'email' => "premium@hsh.com",'email_verified_at' => now(),'dni' => '12345678','password' => bcrypt('user'),'fecha_nac'=> '1990-04-25','direccion' => '8687 Schmidt Mall Suite 302v chneiderside, AK 98411-4359','telefono' =>'(626) 255-7313 x8563','semanas_disp' => 1,'solicito_upgrade' => true, 'pago_tipo' =>'Visa','pago_numero' => '2720656886308687','pago_cvv' => '658','pago_vencimiento' => '11/20','remember_token' => Str::random(10),'tipo_de_usuario' => 3]);
      User::create(['name' => "Usuario Estandar",'email' => "standard@hsh.com",'email_verified_at' => now(),'dni' => '12345679','password' => bcrypt('user'),'fecha_nac'=> '1990-04-25','direccion' => '8687 Schmidt Mall Suite 302v chneiderside, AK 98411-4359','telefono' =>'(626) 255-7313 x8563','semanas_disp' => 1,'solicito_upgrade' => false, 'pago_tipo' =>'Visa','pago_numero' => '2720656886308687','pago_cvv' => '658','pago_vencimiento' => '11/20','remember_token' => Str::random(10),'tipo_de_usuario' => 2]);
      User::create(['name' => "Usuario Sin verificar",'email' => "unverified@hsh.com",'email_verified_at' => now(),'dni' => '12345680','password' => bcrypt('user'),'fecha_nac'=> '1990-04-25','direccion' => '8687 Schmidt Mall Suite 302v chneiderside, AK 98411-4359','telefono' =>'(626) 255-7313 x8563','semanas_disp' => 0,'solicito_upgrade' => false, 'pago_tipo' =>'Visa','pago_numero' => '2720656886308687','pago_cvv' => '658','pago_vencimiento' => '11/20','remember_token' => Str::random(10),'tipo_de_usuario' => 1]);
      // factory(User::class)->times(15)->create();
      User::create(['name' => "Emmanuele Beltane Armenta Pareta",'direccion' => "Avenida Mourelos No. 732",'telefono' => '+54(141)-5112576', 'dni' => '31093068','fecha_nac' => '2000-01-03','email' => "lina_d@hotmail.com",'password' => bcrypt('password'),'email_verified_at' => now(),'remember_token' => Str::random(10),'tipo_de_usuario' => 3,'semanas_disp' => 1, 'pago_tipo' => "Visa", 'pago_numero' => 123456789876, 'pago_cvv' => 123, 'pago_vencimiento' => '01/20', 'solicito_upgrade' => 0]);
      User::create(['name' => "Daren Parry Rani",'direccion' => "Boulevard Valdez No. 865",'telefono' => '+54(050)-0668794','fecha_nac' => '1994-01-15','email' => "oina1@hotmail.com",'password' => bcrypt('password'),'dni' => '27623903','email_verified_at' => now(),'remember_token' => Str::random(10),'tipo_de_usuario' => 3,'semanas_disp' => 2, 'pago_tipo' => "Visa", 'pago_numero' => 123456789876, 'pago_cvv' => 123, 'pago_vencimiento' => '01/20', 'solicito_upgrade' => 0]);
      User::create(['name' => "Amado Antonio López de Mota Rinaldi",'direccion' => "Real del Baudet No. 529",'telefono' => '+54(434)-7006144','fecha_nac' => '1987-04-10','email' => "helado21@hotmail.com",'password' => bcrypt('password'),'dni' => '37936634','email_verified_at' => now(),'remember_token' => Str::random(10),'tipo_de_usuario' => 3,'semanas_disp' => 2, 'pago_tipo' => "Visa", 'pago_numero' => 123456789876, 'pago_cvv' => 123, 'pago_vencimiento' => '01/20', 'solicito_upgrade' => 0]);
      User::create(['name' => "Óscar De la Granja De la Colina",'direccion' => "Real del Rabat No. 362",'telefono' => '+54(848)-6336906','email' => "hddelacolina3@hotmail.com",'fecha_nac' => '1986-08-11','password' => bcrypt('password'),'dni' => '35538605','email_verified_at' => now(),'remember_token' => Str::random(10),'tipo_de_usuario' => 3,'semanas_disp' => 2, 'pago_tipo' => "Visa", 'pago_numero' => 123456789876, 'pago_cvv' => 123, 'pago_vencimiento' => '01/20', 'solicito_upgrade' => 0]);
      User::create(['name' => "Mimount Cabiedas Shevchuk",'direccion' => "Boulevard Cotacachi No. 934",'telefono' => '+54(232)-4005632','email' => "hmshevchuk12@yopmail.com",'fecha_nac' => '1990-03-19','password' => bcrypt('password'),'dni' => '17170516','email_verified_at' => now(),'remember_token' => Str::random(10),'tipo_de_usuario' => 3,'semanas_disp' => 2, 'pago_tipo' => "Visa", 'pago_numero' => 123456789876, 'pago_cvv' => 123, 'pago_vencimiento' => '01/20', 'solicito_upgrade' => 0]);
      User::create(['name' => "Lorena Arismendi Jaraquemada",'direccion' => "Taheri No. 941",'telefono' => '+54(030)-8117057','email' => "bblorena1@yopmail.com",'fecha_nac' => '1956-10-28','password' => bcrypt('password'),'dni' => '24719994','email_verified_at' => now(),'remember_token' => Str::random(10),'tipo_de_usuario' => 3,'semanas_disp' => 2, 'pago_tipo' => "Visa", 'pago_numero' => 123456789876, 'pago_cvv' => 123, 'pago_vencimiento' => '01/20', 'solicito_upgrade' => 0]);
      User::create(['name' => "Santiago Tamboleo Bombillar",'direccion' => "Bulevar Mostacero No. 719",'telefono' => '+54(444)-1774201','email' => "gvtorrento21@yopmail.com",'fecha_nac' => '1969-10-26','password' => bcrypt('password'),'dni' => '23717703','email_verified_at' => now(),'remember_token' => Str::random(10),'tipo_de_usuario' => 3,'semanas_disp' => 2, 'pago_tipo' => "Visa", 'pago_numero' => 123456789876, 'pago_cvv' => 123, 'pago_vencimiento' => '01/20', 'solicito_upgrade' => 0]);
      User::create(['name' => "Adán Lanzon Riza",'direccion' => "Calle Santo del Pedrejon No. 847",'telefono' => '+54(737)-2117521','email' => "ut@dignissimlacusAliquam.ca",'fecha_nac' => '1975-11-15','password' => bcrypt('password'),'dni' => '28692724','email_verified_at' => now(),'remember_token' => Str::random(10),'tipo_de_usuario' => 3,'semanas_disp' => 2, 'pago_tipo' => "Visa", 'pago_numero' => 123456789876, 'pago_cvv' => 123, 'pago_vencimiento' => '01/20', 'solicito_upgrade' => 0]);
      User::create(['name' => "Romeo Caballero Fariss",'direccion' => "Calle Santo del Hosea No. 933",'telefono' => '+54(242)-0990550','email' => "et@gravida.com",'fecha_nac' => '2000-09-25','password' => bcrypt('password'),'dni' => '15424759','email_verified_at' => now(),'remember_token' => Str::random(10),'tipo_de_usuario' => 3,'semanas_disp' => 2, 'pago_tipo' => "Visa", 'pago_numero' => 123456789876, 'pago_cvv' => 123, 'pago_vencimiento' => '01/20', 'solicito_upgrade' => 0]);
      User::create(['name' => "Casimiro Q. Castellsague Mares",'direccion' => "Privada Khadraoui No. 284",'telefono' => '+54(858)-3992172','email' => "ipsum.sodales@ideratEtiam.org",'fecha_nac' => '1951-11-06','password' => bcrypt('password'),'dni' => '41304980','email_verified_at' => now(),'remember_token' => Str::random(10),'tipo_de_usuario' => 3,'semanas_disp' => 2, 'pago_tipo' => "Visa", 'pago_numero' => 123456789876, 'pago_cvv' => 123, 'pago_vencimiento' => '01/20', 'solicito_upgrade' => 0]);
      User::create(['name' => "Joaquim I. Sanchez Estrelles",'direccion' => "Boulevard Mascareño No. 900",'telefono' => '+54(343)-1339389','email' => "et.lacinia@maurissapiencursus.net",'fecha_nac' => '1985-08-25','password' => bcrypt('password'),'dni' => '16855390','email_verified_at' => now(),'remember_token' => Str::random(10),'tipo_de_usuario' => 3,'semanas_disp' => 2, 'pago_tipo' => "Visa", 'pago_numero' => 123456789876, 'pago_cvv' => 123, 'pago_vencimiento' => '01/20', 'solicito_upgrade' => 0]);
      User::create(['name' => "Gaspar Evelio Bustos Punta",'direccion' => "Bulevar Canicio No. 55",'telefono' => '+54(535)-9663081','email' => "Etiam@dolortempusnon.net",'fecha_nac' => '1993-12-24','password' => bcrypt('password'),'dni' => '31880759','email_verified_at' => now(),'remember_token' => Str::random(10),'tipo_de_usuario' => 3,'semanas_disp' => 2, 'pago_tipo' => "Visa", 'pago_numero' => 123456789876, 'pago_cvv' => 123, 'pago_vencimiento' => '01/20', 'solicito_upgrade' => 0]);
      User::create(['name' => "Rene O'Reilly Romeralo",'direccion' => "Boulevard Khalifa No. 647",'telefono' => '+54(959)-4662680','email' => "gravida.Aliquam@Vestibulumante.org",'fecha_nac' => '1996-10-08','password' => bcrypt('password'),'dni' => '37423219','email_verified_at' => now(),'remember_token' => Str::random(10),'tipo_de_usuario' => 3,'semanas_disp' => 2, 'pago_tipo' => "Visa", 'pago_numero' => 123456789876, 'pago_cvv' => 123, 'pago_vencimiento' => '01/20', 'solicito_upgrade' => 0]);
      User::create(['name' => "Frida Celeste Akil Fossas",'direccion' => "Real del Acharki No. 972",'telefono' => '+54(232)-2668184','email' => "Proin.sed.turpis@sociisnatoque.org",'fecha_nac' => '1998-04-21','password' => bcrypt('password'),'dni' => '26298871','email_verified_at' => now(),'remember_token' => Str::random(10),'tipo_de_usuario' => 3,'semanas_disp' => 2, 'pago_tipo' => "Visa", 'pago_numero' => 123456789876, 'pago_cvv' => 123, 'pago_vencimiento' => '01/20', 'solicito_upgrade' => 0]);
      User::create(['name' => "Vanesa Mercedes Arandes Ghazal",'direccion' => "Bulevar Madriz No. 2",'telefono' => '+54(949)-4998450','email' => "Vivamus.nisi.Mauris@non.net",'fecha_nac' => '1953-07-18','password' => bcrypt('password'),'dni' => '40754496','email_verified_at' => now(),'remember_token' => Str::random(10),'tipo_de_usuario' => 3,'semanas_disp' => 2, 'pago_tipo' => "Visa", 'pago_numero' => 123456789876, 'pago_cvv' => 123, 'pago_vencimiento' => '01/20', 'solicito_upgrade' => 0]);
      User::create(['name' => "Sol Fiona Sellens Terciado",'direccion' => "Privada Tarapaca No. 641",'telefono' => '+54(545)-3441464','email' => "nisi.a@eleifendnon.net",'fecha_nac' => '1963-12-01','password' => bcrypt('password'),'dni' => '17058549','email_verified_at' => now(),'remember_token' => Str::random(10),'tipo_de_usuario' => 3,'semanas_disp' => 2, 'pago_tipo' => "Visa", 'pago_numero' => 123456789876, 'pago_cvv' => 123, 'pago_vencimiento' => '01/20', 'solicito_upgrade' => 0]);
      User::create(['name' => "Talia Ladino Zalaya",'direccion' => "",'telefono' => '','email' => "Aliquam.vulputate@id.co.uk",'fecha_nac' => '1991-02-15','password' => bcrypt('password'),'dni' => '24849857','email_verified_at' => now(),'remember_token' => Str::random(10),'tipo_de_usuario' => 3,'semanas_disp' => 2, 'pago_tipo' => "Visa", 'pago_numero' => 123456789876, 'pago_cvv' => 123, 'pago_vencimiento' => '01/20', 'solicito_upgrade' => 0]);
      User::create(['name' => "Linda Bamio Amza",'direccion' => "Real del Martínez de Morentin No. 356",'telefono' => '+54(141)-6661229','email' => "Quisque.imperdiet@nibh.org",'fecha_nac' => '1985-06-22','password' => bcrypt('password'),'dni' => '27617377','email_verified_at' => now(),'remember_token' => Str::random(10),'tipo_de_usuario' => 3,'semanas_disp' => 2, 'pago_tipo' => "Visa", 'pago_numero' => 123456789876, 'pago_cvv' => 123, 'pago_vencimiento' => '01/20', 'solicito_upgrade' => 0]);
      User::create(['name' => "Alexis Lyazidi Quinones",'direccion' => "Avenida Kadi No. 472",'telefono' => '+54(454)-3442909','email' => "diam.Duis.mi@orciPhasellus.edu",'fecha_nac' => '1983-02-12','password' => bcrypt('password'),'dni' => '16321738','email_verified_at' => now(),'remember_token' => Str::random(10),'tipo_de_usuario' => 3,'semanas_disp' => 2, 'pago_tipo' => "Visa", 'pago_numero' => 123456789876, 'pago_cvv' => 123, 'pago_vencimiento' => '01/20', 'solicito_upgrade' => 0]);
      User::create(['name' => "Caridad C. Bellota Zubiate",'direccion' => "Calle Santo del Cantabria No. 937",'telefono' => '+54(454)-3442141','email' => "vulputate@amet.ca",'fecha_nac' => '1976-07-25','password' => bcrypt('password'),'dni' => '26722915','email_verified_at' => now(),'remember_token' => Str::random(10),'tipo_de_usuario' => 3,'semanas_disp' => 2, 'pago_tipo' => "Visa", 'pago_numero' => 123456789876, 'pago_cvv' => 123, 'pago_vencimiento' => '01/20', 'solicito_upgrade' => 0]);
      User::create(['name' => "Leire X. Valent Barbellido",'direccion' => "Privada Mamadou No. 967",'telefono' => '+54(858)-5116276','email' => "sodales.purus.in@nibhenimgravida.ca",'fecha_nac' => '1966-09-19','password' => bcrypt('password'),'dni' => '10900962','email_verified_at' => now(),'remember_token' => Str::random(10),'tipo_de_usuario' => 3,'semanas_disp' => 2, 'pago_tipo' => "Visa", 'pago_numero' => 123456789876, 'pago_cvv' => 123, 'pago_vencimiento' => '01/20', 'solicito_upgrade' => 0]);
      User::create(['name' => "Maider Q. Chalco Echavarren",'direccion' => "Cerrada Unda No. 808",'telefono' => '+54(131)-3335667','email' => "Quisque.varius.Nam@non.co.uk",'fecha_nac' => '1972-04-01','password' => bcrypt('password'),'dni' => '26285079','email_verified_at' => now(),'remember_token' => Str::random(10),'tipo_de_usuario' => 3,'semanas_disp' => 2, 'pago_tipo' => "Visa", 'pago_numero' => 123456789876, 'pago_cvv' => 123, 'pago_vencimiento' => '01/20', 'solicito_upgrade' => 0]);
      User::create(['name' => "Milagros Garcia Estopañan",'direccion' => "Calle Moreo No. 211",'telefono' => '+54(131)-8773442','email' => "dapibus.id@placerat.edu",'fecha_nac' => '1991-09-23','password' => bcrypt('password'),'dni' => '18776274','email_verified_at' => now(),'remember_token' => Str::random(10),'tipo_de_usuario' => 3,'semanas_disp' => 2, 'pago_tipo' => "Visa", 'pago_numero' => 123456789876, 'pago_cvv' => 123, 'pago_vencimiento' => '01/20', 'solicito_upgrade' => 0]);
      User::create(['name' => "Pilar R. Wague Olah",'direccion' => "Bulevar Inti No. 623",'telefono' => '+54(454)-2228139','email' => "Donec.feugiat.metus@Sed.org",'fecha_nac' => '1975-12-09','password' => bcrypt('password'),'dni' => '33719671','email_verified_at' => now(),'remember_token' => Str::random(10),'tipo_de_usuario' => 3,'semanas_disp' => 2, 'pago_tipo' => "Visa", 'pago_numero' => 123456789876, 'pago_cvv' => 123, 'pago_vencimiento' => '01/20', 'solicito_upgrade' => 0]);
      User::create(['name' => "Alison San Musoles",'direccion' => "Real del Justo No. 907",'telefono' => '+54(050)-1226261','email' => "Integer.mollis.Integer@necleo.net",'fecha_nac' => '1968-03-19','password' => bcrypt('password'),'dni' => '15411234','email_verified_at' => now(),'remember_token' => Str::random(10),'tipo_de_usuario' => 3,'semanas_disp' => 2, 'pago_tipo' => "Visa", 'pago_numero' => 123456789876, 'pago_cvv' => 123, 'pago_vencimiento' => '01/20', 'solicito_upgrade' => 0]);
      User::create(['name' => "Gloria Alexis Zalduendo Canle",'direccion' => "Real del Hamilton No. 774",'telefono' => '+54(444)-2555415','email' => "ut.aliquam.iaculis@scelerisquemollis.co.uk",'fecha_nac' => '1968-03-19','password' => bcrypt('password'),'dni' => '25052660','email_verified_at' => now(),'remember_token' => Str::random(10),'tipo_de_usuario' => 3,'semanas_disp' => 2, 'pago_tipo' => "Visa", 'pago_numero' => 123456789876, 'pago_cvv' => 123, 'pago_vencimiento' => '01/20', 'solicito_upgrade' => 0]);
      User::create(['name' => "Alison Rave Veleiro",'direccion' => "Real del Guarde No. 941",'telefono' => '+54(434)-1885862','email' => "auctor@Quisque.org",'fecha_nac' => '1983-08-04','password' => bcrypt('password'),'dni' => '38054429','email_verified_at' => now(),'remember_token' => Str::random(10),'tipo_de_usuario' => 3,'semanas_disp' => 2, 'pago_tipo' => "Visa", 'pago_numero' => 123456789876, 'pago_cvv' => 123, 'pago_vencimiento' => '01/20', 'solicito_upgrade' => 0]);
      User::create(['name' => "Dana Dablanca Vazquez",'direccion' => "Calle Ucin No. 101",'telefono' => '+54(454)-8443283','email' => "metus.In.lorem@Aliquamvulputate.ca",'fecha_nac' => '1974-09-10','password' => bcrypt('password'),'dni' => '10321336','email_verified_at' => now(),'remember_token' => Str::random(10),'tipo_de_usuario' => 3,'semanas_disp' => 2, 'pago_tipo' => "Visa", 'pago_numero' => 123456789876, 'pago_cvv' => 123, 'pago_vencimiento' => '01/20', 'solicito_upgrade' => 0]);
      User::create(['name' => "Celeste Bibiana Creix Susino",'direccion' => "Avenida Baus No. 422",'telefono' => '+54(030)-8558065','email' => "non.massa.non@semvitaealiquam.ca",'fecha_nac' => '1963-01-01','password' => bcrypt('password'),'dni' => '12792855','email_verified_at' => now(),'remember_token' => Str::random(10),'tipo_de_usuario' => 3,'semanas_disp' => 2, 'pago_tipo' => "Visa", 'pago_numero' => 123456789876, 'pago_cvv' => 123, 'pago_vencimiento' => '01/20', 'solicito_upgrade' => 0]);
      User::create(['name' => "Karima Ibarria Guerrero",'direccion' => "Boulevard Schuster No. 554",'telefono' => '+54(737)-3772808','email' => "tincidunt.congue@purusmauris.co.uk",'fecha_nac' => '1974-09-16','password' => bcrypt('password'),'dni' => '22132459','email_verified_at' => now(),'remember_token' => Str::random(10),'tipo_de_usuario' => 3,'semanas_disp' => 2, 'pago_tipo' => "Visa", 'pago_numero' => 123456789876, 'pago_cvv' => 123, 'pago_vencimiento' => '01/20', 'solicito_upgrade' => 0]);
      User::create(['name' => "Clara Guija Jorna",'direccion' => "Avenida Josafat No. 926",'telefono' => '+54(030)-3443327','email' => "vel@leoVivamus.org",'fecha_nac' => '1982-09-12','password' => bcrypt('password'),'dni' => '35503129','email_verified_at' => now(),'remember_token' => Str::random(10),'tipo_de_usuario' => 3,'semanas_disp' => 2, 'pago_tipo' => "Visa", 'pago_numero' => 123456789876, 'pago_cvv' => 123, 'pago_vencimiento' => '01/20', 'solicito_upgrade' => 0]);
      User::create(['name' => "Norma Susino Sánchez",'direccion' => "Real del Dou No. 739",'telefono' => '+54(959)-7007812','email' => "morbi.tristique@enimmi.net",'fecha_nac' => '1950-11-03','password' => bcrypt('password'),'dni' => '21967434','email_verified_at' => now(),'remember_token' => Str::random(10),'tipo_de_usuario' => 3,'semanas_disp' => 2, 'pago_tipo' => "Visa", 'pago_numero' => 123456789876, 'pago_cvv' => 123, 'pago_vencimiento' => '01/20', 'solicito_upgrade' => 0]);
      User::create(['name' => "Dulce Villullas Davalillo",'direccion' => "Calle Reborido No. 31",'telefono' => '+54(535)-1227979','email' => "nec.quam@tempor.edu",'fecha_nac' => '1956-05-28','password' => bcrypt('password'),'dni' => '27953119','email_verified_at' => now(),'remember_token' => Str::random(10),'tipo_de_usuario' => 3,'semanas_disp' => 2, 'pago_tipo' => "Visa", 'pago_numero' => 123456789876, 'pago_cvv' => 123, 'pago_vencimiento' => '01/20', 'solicito_upgrade' => 0]);
      User::create(['name' => "Alana Paz Tablero Rangelova",'direccion' => "Calle Alabern No. 226",'telefono' => '+54(434)-3664662','email' => "pulvinar@risus.net",'fecha_nac' => '1952-01-21','password' => bcrypt('password'),'dni' => '12798861','email_verified_at' => now(),'remember_token' => Str::random(10),'tipo_de_usuario' => 3,'semanas_disp' => 2, 'pago_tipo' => "Visa", 'pago_numero' => 123456789876, 'pago_cvv' => 123, 'pago_vencimiento' => '01/20', 'solicito_upgrade' => 0]);
      User::create(['name' => "Bibiana Gina Bhatia Armenta",'direccion' => "Real del Rio Negro No. 862",'telefono' => '+54(141)-7005634','email' => "tempus.lorem@elitafeugiat.ca",'fecha_nac' => '1999-08-21','password' => bcrypt('password'),'dni' => '18816623','email_verified_at' => now(),'remember_token' => Str::random(10),'tipo_de_usuario' => 3,'semanas_disp' => 2, 'pago_tipo' => "Visa", 'pago_numero' => 123456789876, 'pago_cvv' => 123, 'pago_vencimiento' => '01/20', 'solicito_upgrade' => 0]);
      User::create(['name' => "Laila Embun Pumarola",'direccion' => "Calle Tocantins No. 645",'telefono' => '+54(656)-1113261','email' => "facilisis.Suspendisse.commodo@eleifendCrassed.net",'fecha_nac' => '1981-09-30','password' => bcrypt('password'),'dni' => '40800623','email_verified_at' => now(),'remember_token' => Str::random(10),'tipo_de_usuario' => 3,'semanas_disp' => 2, 'pago_tipo' => "Visa", 'pago_numero' => 123456789876, 'pago_cvv' => 123, 'pago_vencimiento' => '01/20', 'solicito_upgrade' => 0]);
      User::create(['name' => "Aina Roybal Hernamperez",'direccion' => "Calle Santiño No. 909",'telefono' => '+54(959)-5221921','email' => "neque.Nullam.ut@uterosnon.co.uk",'fecha_nac' => '1973-07-05','password' => bcrypt('password'),'dni' => '14874696','email_verified_at' => now(),'remember_token' => Str::random(10),'tipo_de_usuario' => 3,'semanas_disp' => 2, 'pago_tipo' => "Visa", 'pago_numero' => 123456789876, 'pago_cvv' => 123, 'pago_vencimiento' => '01/20', 'solicito_upgrade' => 0]);
      User::create(['name' => "Natalia Marianela Vila Clemente",'direccion' => "Privada Huhuetenango No. 474",'telefono' => '+54(757)-7554670','email' => "justo.Praesent@nibhlaciniaorci.org",'fecha_nac' => '1970-10-15','password' => bcrypt('password'),'dni' => '28723193','email_verified_at' => now(),'remember_token' => Str::random(10),'tipo_de_usuario' => 3,'semanas_disp' => 2, 'pago_tipo' => "Visa", 'pago_numero' => 123456789876, 'pago_cvv' => 123, 'pago_vencimiento' => '01/20', 'solicito_upgrade' => 0]);
      User::create(['name' => "Sagrario Navarro Rebordosa",'direccion' => "Privada Arnejo No. 823",'telefono' => '+54(535)-8004537','email' => "lacus.Aliquam.rutrum@loremfringilla.edu",'fecha_nac' => '1958-04-23','password' => bcrypt('password'),'dni' => '36689448','email_verified_at' => now(),'remember_token' => Str::random(10),'tipo_de_usuario' => 3,'semanas_disp' => 2, 'pago_tipo' => "Visa", 'pago_numero' => 123456789876, 'pago_cvv' => 123, 'pago_vencimiento' => '01/20', 'solicito_upgrade' => 0]);
      User::create(['name' => "Carina Dinev Bouzan",'direccion' => "Cerrada Roviralta No. 216",'telefono' => '+54(050)-2004684','email' => "eu.neque.pellentesque@tellusSuspendisse.edu",'fecha_nac' => '1975-08-09','password' => bcrypt('password'),'dni' => '15276727','email_verified_at' => now(),'remember_token' => Str::random(10),'tipo_de_usuario' => 3,'semanas_disp' => 2, 'pago_tipo' => "Visa", 'pago_numero' => 123456789876, 'pago_cvv' => 123, 'pago_vencimiento' => '01/20', 'solicito_upgrade' => 0]);
    }
}
