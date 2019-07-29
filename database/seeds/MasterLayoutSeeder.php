<?php

use Illuminate\Database\Seeder;
use App\MasterLayout;

class MasterLayoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      if(Schema::hasTable('master_layout')) {
        
        DB::statement("SET foreign_key_checks=0");
        MasterLayout::truncate();
        DB::statement("SET foreign_key_checks=1");
      }
        
        $layouts = [
           [
               'layout_name' => 'Samata Nagar, Kandivali(E)',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Sardar Nagar 4 , Sion Koliwada',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Abhyudaya Nagar, Kalachowki',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Macchimar Colony, Mahim',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Pant Nagar (Part A &C) Ghatkopar',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Pant Nagar (Part B) Ghatkopar',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Kannamwar Nagar, Vikhroli',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Navghar road, Mulund (E)',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Mithagar road, Mulund',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Chunnabhatti Kurla',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Tilak Nagar, Chembur',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'New Tilak Nagar, Chembur',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Anant Kanekar Marg, Bandra (W)',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Survey no. 7&8 Bandra (W)',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Teachers colony, Bandra (E)',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Anand Nagar, Santa cruz A &B',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Motilal Nagar Part -2 &3',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Siddharth nagar, Part I to IV',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Unnat Nagar, Goregaon',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Mitha nagar, goregaon',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Magathane (Old)Borivali',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Magathane (New)Borivali',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Rajendra Nagar, Borivali',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Gandhi Nagar, Bandra(E)',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Kher Nagar , Bandra (E)',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Asalfa Village, Ghatkopar',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Subhash nagar, chembur',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Nirmal Nagar, Khar (E)',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Chakkikhana, Santa cruz (E)',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Chaitnya Nagar, Santacruz (E)',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Azad Nagar, Andheri',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Nityanand Nagar, Andheri',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Yashwant Nagar, Goregaon',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Site and Services,dindoshi malad',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Chunnabhatti dahisar',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Shashtri nagar, goregaon',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Garam Khada, Lalbaug',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Ramabai nagar, ghatkopar',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Tagor nagar, vikhroli',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Sundar nagar, santa cruz (E)',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Oshiwara jogeshwari',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Oshiwara transit camp (Patliputra nagar)',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Sane guruji nagar, goregaon',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'New subhash nagar, Pahadi goregaon (Kusum shinde)',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Arey colony, goregaon',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Sardar Nagar 1,2,3 Sion Koliwada',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Adarsh Nagar, worli',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Chittaranjan Nagar, Ghatkopar',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Nahur Mulund',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Bandra Reclaimation, Bandra (W)',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Patra Chawl, Goregaon',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Motilal Nagar Part -I',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Dindoshi Malad East (Old shivdham complex)',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Ashok van Borivali',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Turbhe Mandale',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Shivaji nagar, Worli',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Pratiksha Nagar, Sion',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Antop Hill, Wadala',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Kopari Powai',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Mulund PMGP',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'S. No. 138 Mankhurd',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Teachers colony Kurla (W)',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Netaji Nagar Kurla (W)',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Vinoba Bhave Nagar, Transit camp Kurla',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Vinoba Bhave Nagar, Kurla (W)',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Vijay nagar, bandra',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Kolekalyan Santa cruz',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'JVPD vile Parle',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'D.N. Nagar, Andheri',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Aram Nagar, versova',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Sarvodaya nagar, Majaswadi jogeshwari',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'PMGP majaswadi, jogeshwari',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Mahavir Nagar, Kandivali',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Akruli Kandivali',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'S. no. 157 WBP Kandivali',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Poisar Kandivali',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Shailendra Nagar, Dahisar',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Gavan Pada, Mulund',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'PMGP, sion',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Ambedkar nagar, worli',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Chandivali Powai',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'S. no. 386 mulund',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'S. no. 386 WBP mulund',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Nehru nagar, kurla',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Sahakar nagar, Chembur',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Sahakar nagar, chembur (Transit)',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Bharat nagar, bandra (E)',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Ramkrishna nagar, khar',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'S. no. 120 WBP SVP nagar versova',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Versova (MHB) andheri (W)',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Bimbisar Nagar, Goregaon',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Khadakpada dindoshi',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'New Dindoshi malad (E)',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Dadasaheb Gaikwad Nagar, malvani',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'S.no. 263 WBP malavani ',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Gorai road WBP Part 1,2,3',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'S. no, 160 (A/1) CTS no.24 gorai road',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 's. no. 41 charkop WBP (sect 8 & 9)',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Charkop WBP (1 to 4)',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Charkop WBP  sect 7 additional land',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Old MHB colony gorai',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'New MHB colony, gorai road (Ashtavinayak Nagar)',
               'division' => '',
               'board' => 1
           ],[
               'layout_name' => 'Eksar Kandivali',
               'division' => '',
               'board' => 1
           ]
       ];

        foreach ($layouts as $layout) {

            $layout_id = MasterLayout::where('layout_name', $layout['layout_name'])->first();

            if ($layout_id == NULL){
               $layoutsdata[] = $layout;
            }
        }
        MasterLayout::insert($layouts);
    }
}
