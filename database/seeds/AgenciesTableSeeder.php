<?php

use Illuminate\Database\Seeder;

class AgenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $agencies = "   AG. BOLBEC                      
                        AG. MONTVILLE                   
                        AG. BUCHY                       
                        AG. CANY BARVILLE               
                        AG. CRIQUETOT ESNEVAL           
                        AG. DIEPPE                      
                        AG. DOUDEVILLE                  
                        AG. DUCLAIR                     
                        AG. ELBEUF                      
                        AG. ENVERMEU                    
                        AG. EU                          
                        AG. FECAMP                      
                        AG. GOURNAY EN BRAY             
                        AG. GRAND QUEVILLY              
                        AG. LE HAVRE CENTRE             
                        AG. LE HAVRE SUD EST            
                        AG. LE HAVRE VILLE HAUTE        
                        AG. LUNERAY                     
                        AG. MAROMME                     
                        AG. MESNIL ESNARD               
                        AG. BOIS GUILLAUME              
                        AG. MONTIVILLIERS               
                        AG. NEUFCHATEL /BRAY            
                        AG. PAVILLY                     
                        AG. ROUEN                       
                        AG. ROUEN SUD                   
                        AG. SOTTEVILLE                  
                        AG. TOTES                       
                        AG. YVETOT                      
                        AG. LES ANDELYS                 
                        AG. BERNAY                      
                        AG. BEUZEVILLE                  
                        AG. GRAND BOURGTHEROULDE        
                        AG. BRIONNE                     
                        AG. CONCHES EN OUCHE            
                        AG. EVREUX CENTRE               
                        AG. FLEURY SUR ANDELLE          
                        AG. GAILLON                     
                        AG. GISORS                      
                        AG. LOUVIERS                    
                        AG. LE NEUBOURG                 
                        AG. PONT DE L'ARCHE             
                        AG. PACY SUR EURE               
                        AG. PONT AUDEMER                
                        AG. BOURG-ACHARD                
                        AG. RUGLES                      
                        AG. SAINT ANDRE                 
                        AG. THIBERVILLE                 
                        AG. VERNEUIL D AVRE ET D ITON   
                        AG. VERNON                      
                        AG. NONANCOURT                  
                        AG. EVREUX-SUD                  
                        AG. EVREUX-ROCHETTE             
                        AGENCE PLATEFORME TELEPHONIQUE  
                        AGENCE EN LIGNE                 
                        HABITAT ROUEN            
                        HABITAT LE HAVRE         
                        HABITAT EVREUX           
                        BANQUE PRIVEE ROUEN      
                        BANQUE PRIVEE LE HAVRE   
                        BANQUE PRIVEE EVREUX     
                        CENTRE D'AFFAIRES DE ROUEN
                        CENTRE D'AFFAIRES LE HAVRE
                        CENTRE D'AFFAIRES D' EVREUX
                        BANQUE D'AFFAIRES        
                        ASSURANCE PROFESSIONNELS 
                        POLE PROFESSIONNEL DE BERNAY    
                        POLE PRO-AGRI DE BOIS-GUILLAUME 
                        POLE PRO-AGRI DE DIEPPE         
                        POLE PRO-AGRI DE LOUVIERS       
                        POLE PROFESSIONNEL D'EVREUX     
                        POLE PROFESSIONNEL DE FECAMP    
                        POLE PROFESSIONNEL DU HAVRE     
                        POLE PRO-AGRI DE GOURNAY        
                        POLE PRO AGRI DE PONT-AUDEMER   
                        POLE PRO-AGRI DE ROUEN          
                        POLE PROFESSIONNEL DE VERNON    
                        POLE PRO-AGRI YVETOT            
                        ";

        $agencies_list = explode(PHP_EOL, $agencies);
        foreach ($agencies_list as $agency) {
            $agency = trim(str_replace('AG. ' , '' ,$agency));
            if ($agency != '') {
                \Illuminate\Support\Facades\DB::table('agencies')->insert([
                    'name' => $agency
                ]);
            }
        }

    }
}
