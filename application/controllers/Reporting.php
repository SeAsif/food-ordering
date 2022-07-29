<?
/**
*Manager log book
*/
class Reporting extends CI_Controller {

	public function __construct()
	{

	parent::__construct();
	
	}
	

     function index(Type $var = null)
    {
        # code...

        $data["activemenu"]="reporting";
        $this->load->view('restaurantportal/reporting/index',$data);
    }
    
    
    function create(Type $var = null)
    {
        # code...

        $data["activemenu"]="reporting";
        $this->load->view('restaurantportal/reporting/create',$data);
    }

    function store(Type $var = null)
    {
        # code...

        $data["activemenu"]="reporting";
        $this->load->view('restaurantportal/reporting/create',$data);
    }

    function edit(Type $var = null)
    {
        # code...

        $data["activemenu"]="reporting";
        $this->load->view('restaurantportal/reporting/edit',$data);
    }

    function update(Type $var = null)
    {
        # code...

        $data["activemenu"]="reporting";
        $this->load->view('restaurantportal/reporting/edit',$data);
    }


    function delete(Type $var = null)
    {
        # code...

        $data["activemenu"]="reporting";
        $this->load->view('restaurantportal/reporting/index',$data);
    }
}


?>