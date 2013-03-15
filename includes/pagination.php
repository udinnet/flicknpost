<?php
require_once (LIB_PATH.DS.'database.php');
require_once (LIB_PATH.DS.'photograph.php');
//pagination helper class
class Pagination
{
    public $current_page;
    public $total_count;
    public $per_page;
    
    public function __construct($per_page=10, $current_page=1, $total_count=0) {
        $this->current_page = $current_page;
        $this->per_page = $per_page;
        $this->total_count = $total_count;
    }
    
    public function total_pages() {
        return ceil($this->total_count/$this->per_page);
    }
    
    public function previous_page() {
        return $this->current_page-1;
    }
    
    public function next_page() {
        return $this->current_page+1;
    }
    
    public function has_previous_page() {
        return $this->previous_page()>=1 ? true:false;
    }
    
    public function has_next_page() {
        return $this->next_page() <= $this->total_pages() ? true:false;
    }
    
    public function offset () {
        //off-the set
        // if current page is 1 offset is 0 
        //if currnet page is 2 offset is 10
        return $this->per_page*($this->current_page-1);
    }
    
    //pagination DB method
    public function get_pagination() {
        $sql = "SELECT * FROM photographs";
        $sql .= " ORDER BY `id` DESC";
        $sql .= " LIMIT {$this->per_page}";
        $sql .= " OFFSET {$this->offset()}";
        return Photograph::find_by_sql($sql);
    }
}
?>
