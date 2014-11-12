<?php
App::uses('AppController', 'Controller');
/**
 * Ports Controller
 *
 * @property Port $Port
 * @property PaginatorComponent $Paginator
 */
class PortsController extends AppController 
{
        public $uses = array('Port', 'Country');
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');


        public function ajax_get($countryId = null)
        {
            $this->layout = "ajax";
            
            if(($countryId != null))
            {
                $result = $this->Port->find("all", array(
                    "conditions" => "Port.country_id = ".$countryId,
                    "fields" => array("Port.id", "Port.name")));
                
                echo json_encode($result);
            }
        }
        
        public function dashboard_customAdd()
        {
            $this->set("lastId", null);
            if($this->request->is("post"))
            {
                $content = $this->request->data['content'];
                $items = explode("\t", $content);
                $count = 0;
                $result = array();
                foreach ($items as $item)
                {
                    if($count%2== 0)
                    {
                        $port = explode("\n", $item);
                        if(count($port) == 1)
                        {
                            $port = $port[0];
                        }
                        else
                        {
                            $port = $port[1];
                        }

                        $port = trim($port);
                        
                        if(strlen($port) != 0)
                        {
                            $result[] = $port;
                            $data = array(
                                "name" => $port,
                                "country_id" => $this->request->data['Country']['id']
                            );
                            $this->Port->create();
                            $this->Port->save($data);
                        }
                    }
                    $count++;               

                }
                $this->set("lastId", $this->request->data['Country']['id']);
                $this->set("result", implode("\n", $result));
            }
            
            $countries = $this->Country->find("all");
            
            $this->set("countries", $countries);
        }
}
