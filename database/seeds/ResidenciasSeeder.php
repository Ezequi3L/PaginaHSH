<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Residencia;
class ResidenciasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //      factory(App\Residencia::class)->times(17)->create();

        Residencia::create([
          'descripcion' => 'Departamento amplio en Mar del Plata, Argentina. Con vista al mar en lujoso edificio.', 'ubicacion_id' => 1, 'ubicacion_precisa' => 'Rambla Pellerots mesturassin retrumfat, 148A' ]);

        Residencia::create([
          'descripcion' => 'Casa con amplio patio y pileta ubicacada en Mar del Plata, en las cercanias de centro comercial', 'ubicacion_id' => 1, 'ubicacion_precisa' => 'Pasaje Dejectàssiu enrajolésseu frueixen freturaríeu, 128A 19ºA' ]);

        Residencia::create([
          'descripcion' => 'Departamento de 3 habitaciones y gran estar en el centro de Mar del Plata', 'ubicacion_id' => 1,  'ubicacion_precisa' => 'Calle Olorar, 213 5ºF' ]);

        Residencia::create([
          'descripcion' => 'Chalet con grandes comodidades en las cercanias de la costa de Mar del Plata', 'ubicacion_id' => 1,  'ubicacion_precisa' => 'Callejón Remuntadors atenuïs, 108B 20ºB' ]);

        Residencia::create([
          'descripcion' => 'Residencia luminosa con acceso directo al mar, en Mar del Plata, Argentina', 'ubicacion_id' => 1,  'ubicacion_precisa' => 'Carrera Desenllaminisc, 89A 1ºE' ]);

        Residencia::create([
          'descripcion' => 'Residencia lujosa en el centro de Roma', 'ubicacion_id' => 6,  'ubicacion_precisa' => 'Paseo Metoditzarà deturpàssim, 9B 10ºA' ]);

        Residencia::create([
          'descripcion' => 'Departamento en planta alta con gran espacio y comodidades en Roma', 'ubicacion_id' => 6,'ubicacion_precisa' => 'Vía Croquisí pregoneres ratina restrenyéssem, 25A 1ºG' ]);

        Residencia::create([
          'descripcion' => 'Casa antigua restaurada en zona historica. Roma, Italia.', 'ubicacion_id' => 6,'ubicacion_precisa' => 'Carrer Escuaven, 178B 18ºC
' ]);

        Residencia::create([
          'descripcion' => 'Casa moderna con amplia luminosidad. Roma Italia.', 'ubicacion_id' => 6,'ubicacion_precisa' => 'Cañada Emproessis, 208 6ºC
' ]);

        Residencia::create([
          'descripcion' => 'Departamento amplio ubicado en las cercanias del Museo del Roma.', 'ubicacion_id' => 6,'ubicacion_precisa' => 'Carrera Desmilitaritz llefiscosos predicot, 79' ]);

        Residencia::create([
          'descripcion' => 'Residencia ubicada en zona comercial, CABA, Argeentina', 'ubicacion_id' => 2,  'ubicacion_precisa' => 'Urbanización Domesticàrem, 198A 2ºE
' ]);

        Residencia::create([
          'descripcion' => 'Casa amplia ubicada en zona residencial, CABA, Argentina', 'ubicacion_id' => 2,  'ubicacion_precisa' => 'Calle Desengavanyarem corrugaríem agulleteres, 280A
' ]);

        Residencia::create([
          'descripcion' => 'Departamento en zona Puerto Madero, CABA, Argentina', 'ubicacion_id' => 2,  'ubicacion_precisa' => 'Plaza Exemplificares, 267A
' ]);

        Residencia::create([
          'descripcion' => 'Departamento en zona comercial, CABA, Argentina', 'ubicacion_id' => 2,  'ubicacion_precisa' => 'Glorieta Magnanimitat deïficats assoleixen capdellaners, 269A 5ºG
' ]);

        Residencia::create([
          'descripcion' => 'Departamento en zona turistica, CABA, Argentina', 'ubicacion_id' => 2,'ubicacion_precisa' => 'Pasadizo Protestades influeixes costellut, 176A 9ºH
' ]);

        Residencia::create([
          'descripcion' => 'Departamento moderno en Tokio, Japon', 'ubicacion_id' => 7,  'ubicacion_precisa' => 'Paseo Matament desmescleu, 159A 6ºF
' ]);

        Residencia::create([
          'descripcion' => 'Casa antigua en Tokio, Japon', 'ubicacion_id' => 7,  'ubicacion_precisa' => 'Callejón Palmegessen atraçades quequegéssim micorizàrem, 266A 7ºD
' ]);

        Residencia::create([
          'descripcion' => 'Residencia en zona historica, Tokio, Japon', 'ubicacion_id' => 7,  'ubicacion_precisa' => 'Acceso Arramblada laurats trepolles noètica, 247 7ºE
' ]);

        Residencia::create([
          'descripcion' => 'Residencia en zona comercial, Tokio, Japon', 'ubicacion_id' => 7,  'ubicacion_precisa' => 'Urbanización Traspost lubricava antivariolosos plenament, 94
' ]);

        Residencia::create([
          'descripcion' => 'Departamento en zona turistica, Tokio, Japon' => 7,  'ubicacion_precisa' => 'Calle Arranen malparlaven perduraries sagratines, 295 2ºE
' ]);

        Residencia::create([
          'descripcion' => 'Departamento en centro comercial de Posadas, Misiones', 'ubicacion_id' => 3,  'ubicacion_precisa' => 'Callejón Muntanyejàs litiguésseu desforestéssem galonegem, 120B
' ]);

        Residencia::create([
          'descripcion' => 'Casa ubicada en cercanias a Cataratas del Iguazu', 'ubicacion_id' => 3,'ubicacion_precisa' => 'Pasadizo Embroquerés norantejàveu estiréssim, 230B 20ºD
' ]);

        Residencia::create([
          'descripcion' => 'Departamento en zona centrica de Posadas, Misiones', 'ubicacion_id' => 3,  'ubicacion_precisa' => 'Pasaje Assistisquen sobrevolaries xirigar embotjareu, 121B
' ]);

        Residencia::create([
          'descripcion' => 'Residencia en centro comercial, Posadas, Misiones', 'ubicacion_id' => 3,'ubicacion_precisa' => 'C. Comercial Barró cotneu turmell esbardisséssem, 69A 1ºG
' ]);

        Residencia::create([
          'descripcion' => 'Departamento en las cercanias de Cataratas del Iguazu', 'ubicacion_id' => 3,  'ubicacion_precisa' => 'Carretera Aixequessin quitis clascar, 281A 9ºD
' ]);

        Residencia::create([
          'descripcion' => 'Casa moderna en Monaco', 'ubicacion_id' => 8,  'ubicacion_precisa' => 'Pasaje Desguarnit embrollaren, 8
' ]);

        Residencia::create([
          'descripcion' => 'Residencia antigua restaurada en Monaco', 'ubicacion_id' => 8,'ubicacion_precisa' => 'Carretera Païu destempteu, 5A 8ºA
' ]);

        Residencia::create([
          'descripcion' => 'Residencia en Centro de Monaco', 'ubicacion_id' => 8'ubicacion_precisa' => 'Camino Bastitans sil·logitzis pree neulassis, 166
' ]);

        Residencia::create([
          'descripcion' => 'Casa antigua, Monaco', 'ubicacion_id' => 8,'ubicacion_precisa' => 'Cuesta Emmenares, 283 19ºF
' ]);

        Residencia::create([
          'descripcion' => 'Departamento en centro comercial, Monaco', 'ubicacion_id' => 8,  'ubicacion_precisa' => 'Camino Cebollí gunitaríem, 249B 20ºB
' ]);

        Residencia::create([
          'descripcion' => 'Departamento cercano a Torre Eiffel', 'ubicacion_id' => 4,'ubicacion_precisa' => 'Travesía Privilegiaren víbria, 55 16ºH
' ]);

        Residencia::create([
          'descripcion' => 'Casa con gran vista, Paris, Francia', 'ubicacion_id' => 4,  'ubicacion_precisa' => 'Acceso Emmalurant, 198A 13ºC
' ]);

        Residencia::create([
          'descripcion' => 'Departamento en zona turistica, Paris, Francia', 'ubicacion_id' => 4,  'ubicacion_precisa' => 'Travesía Encaironessis diagonal desengatgí memoritza, 174 19ºE
' ]);

        Residencia::create([
          'descripcion' => 'Casa cercana a Torre Eiffel', 'ubicacion_id' => 4  'ubicacion_precisa' => 'Paseo Aixerriéssim emboniquí, 27B
' ]);

        Residencia::create([
          'descripcion' => 'Chalet con amplio espacio en Paris, Francia', 'ubicacion_id' => 4,'ubicacion_precisa' => 'Glorieta Relacioni desempestada convalidares ensalivaren, 34B 15ºE
' ]);

        Residencia::create([
          'descripcion' => 'Departamento en zona Turistica, Nueva York', 'ubicacion_id' => 9,  'ubicacion_precisa' => 'Vía Desenlleganyassis marfonguessis shakespearians somou, 197B 3ºC
' ]);

        Residencia::create([
          'descripcion' => 'Departamento en centro comercial, Nueva York', 'ubicacion_id' => 9,  'ubicacion_precisa' => 'Carrer Colcaves moralitzaran adolf, 35A 6ºG
' ]);

        Residencia::create([
          'descripcion' => 'Departamento lujoso y con gran espacio, Nueva York', 'ubicacion_id' => 9,'ubicacion_precisa' => 'Carretera Obsessiu masmitjà digitàrem, 289B
' ]);

        Residencia::create([
          'descripcion' => 'Casa antigua restaurada, Nueva York.', 'ubicacion_id' => 9,  'ubicacion_precisa' => 'Calle Fesomia absentessis, 30A 19ºE
' ]);

        Residencia::create([
          'descripcion' => 'Chalet en cercanias de zona historica, Nueva York.', 'ubicacion_id' => 9,'ubicacion_precisa' => 'Cuesta Esmoquin, 121B 10ºB
' ]);

        Residencia::create([
          'descripcion' => 'Residencia con amplio espacio, Madrid, España', 'ubicacion_id' => 5,  'ubicacion_precisa' => 'Avenida Riallege dolorejant, 193B
' ]);

        Residencia::create([
          'descripcion' => 'Departamento en zona residencial, Madrid,España', 'ubicacion_id' => 5,  'ubicacion_precisa' => 'Carrer Preconcebut hereter, 295A 20ºF
' ]);

        Residencia::create([
          'descripcion' => 'Residencia en zona turistica, Madrid, España', 'ubicacion_id' => 5,'ubicacion_precisa' => 'Pasaje Gargaritzaren, 234B 2ºC
' ]);

        Residencia::create([
          'descripcion' => 'Casa en zona turistica, Madrid, España', 'ubicacion_id' => 5,  'ubicacion_precisa' => 'Camino Preposteressin gargaritzaríeu desarboraven readaptabilitats, 39 10ºG
' ]);

        Residencia::create([
          'descripcion' => 'Departamento en zona historica, Madrid, España', 'ubicacion_id' => 5,  'ubicacion_precisa' => 'Callejón Retrocediu cornamenta caramel·litza, 63 1ºG
' ]);

        Residencia::create([
          'descripcion' => 'Departamento en zona Turistica, Orlando', 'ubicacion_id' => 10,'ubicacion_precisa' => 'Cañada Destalonaria, 137 8ºF
' ]);

        Residencia::create([
          'descripcion' => 'Chalet en cercanias del Orlando Resort', 'ubicacion_id' => 10,  'ubicacion_precisa' => 'Rambla Inaplicables podis menysvalorareu, 39B
' ]);

        Residencia::create([
          'descripcion' => 'Residencia en zona Residencial, Orlando', 'ubicacion_id' => 10,'ubicacion_precisa' => 'Vía Palesament finejàssiu, 115A 4ºE
' ]);

        Residencia::create([
          'descripcion' => 'Departamento con vista al centro comercial, Orlando', 'ubicacion_id' => 10,  'ubicacion_precisa' => 'Alameda Garrofí romanitzàveu rebotria, 293 11ºC
' ]);

        Residencia::create([
          'descripcion' => 'Departamento en el centro turistico, Orlando', 'ubicacion_id' => 10,  'ubicacion_precisa' => 'Plaza Carcompram, 108 7ºC
' ]);
    }
}
