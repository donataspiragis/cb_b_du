<?php
namespace App\Model;

    use DataBase\Connection;
    use Carbon\Carbon;
    use Symfony\Component\HttpFoundation\Request;
    use PDO;

class Model {
    public static $carb;
    protected  $table;
    protected $atributes = [];


    /**
     * Give model a table name
     *
     */
    public function __construct()
    {

        if($this->table != null){

        }else {
            $classname = get_called_class();
            trigger_error("Model $classname Doesnt have param: table", E_USER_ERROR);
        }
    }

    public static function carbonTime(){
        self::$carb = Carbon::now()->setTimezone('Europe/Vilnius');
        return self::$carb;
    }

    /**
     * Get the table information  associated with the model.
     * @return array
     */
     public static function getAll($limit = "",$addition=""){

        return (new Connection())->all(new static(),$limit,$addition);
        //return new static();

    }

    public function getTable(){
        return $this->table;
    }
    /**
     * Get the table information  associated with the model.
     * Table usage in child model: return $this->getWere();
     * $data =[key=>value]; $data of table columns
     * @param string $where
     * @param string $select
     * @param string $addition
     * @return array
     */
   public static function getWere($where,$addition="",$select="*"){
    preg_match('/^.+?\= *(.+)$/is', $where, $matches, PREG_OFFSET_CAPTURE);
    if($matches != null){
        $newstring = $matches[1][0];
        $were = str_replace("$newstring","'$newstring'",$where);
    }else{
        $were = $where;
    }

        $table = (new static)->getTable();
        if($where != ""){
            $sql = "SELECT $select FROM $table WHERE $were $addition";
            return (new Connection())->getWEREData(new static(),$sql);

        }else {

            $sql = "SELECT $select FROM $table $addition";
            return (new Connection())->getWEREData(new static(),$sql);
        }
        return [];

    }


    /**
     * Insert the table information  associated with the model.
     * @return boolean
     */
    protected function storeData(){
        $this->getAllatributes();
        $values='';
        $keys='';
        foreach ($this->atributes as $key=>$value){
            if($key != 'ID') {
                $keys .= ",`$key`";
                $values .= ",:$key";
            }
            if($key == "created_on"){
                $this->atributes["created_on"] = self::carbonTime();
            }
        }
        $keys = substr($keys,1);
        $values = substr($values,1);

        $sql = "INSERT INTO $this->table  ($keys) VALUES ($values)";
        $this->setId((new Connection())->saveData($sql,$this->atributes));

        return true;
    }
    private function setId($id){
        $this->atributes["ID"] = $id;
    }
    /**
     * Update the table information  associated with the model.
     * @return boolean
     */
    protected function updateData(){
        $keys='';
        foreach ($this->atributes as $key=>$value){

//            if($key != 'ID') {
                $keys .= ",`$key`=:$key";
//            }

            if($key == "edited_on"){
                $this->atributes["edited_on"] = self::carbonTime();
            }
        }
        $keys = substr($keys,1);

        $sql = "UPDATE $this->table SET $keys WHERE ID=:ID";

        (new Connection())->saveData($sql, $this->atributes);
        return true;
    }
    /**
     * Delete the table information  associated with the model.
     * Table usage in child model: return $this->deleteData($where);
     * $where =[key=>value]; $where is column name and value which tells where to delete
     * @param $where
     * @return boolean
     */
    protected function deleteData($where){
        $data = ['Archived'=>true];
        $data = array_merge($data,$where);
        $wheres = array_key_first($where)."=:".array_key_first($where);
        $sql = "UPDATE $this->table SET Archived=:Archived WHERE $wheres";
        (new Connection())->saveData($sql, $data);
        return true;
    }

    public function delete(){
	if($this->ID == null){
            return null;

        }else{
        $sql = "DELETE FROM $this->table WHERE ID=:ID";
	return (new Connection())->deleteData($sql, ["ID"=>$this->ID]);
            
        }
        return false;

}
    public function save(){
        if(array_key_exists('ID', $this->atributes)){
            $this->updateData();

        }else{

            $this->storeData();
        }
        return false;
    }

    public function __get( $key )
    {
        return $this->atributes[ $key ];
    }

    public function __set( $key, $value )
    {
        $this->atributes[ $key ] = $value;
    }

    public function __isset($key)
    {
        return $this->atributes[ $key ];
    }

    private function getAllatributes() {
        $data_array = (new Connection())->getTableNames($this->table);

        foreach ($data_array as $value) {
            if($value =="created_on"){

                $this->atributes[$value] = '';
            }
        }
    }

    public function getRowWithColumns() {
        return $this->atributes;
    }

    /**
     * @param string $table_name
     * @param string $column_name
     * @param $value
     * @return array
     */
    public static function rowsByValueExists(string $table_name, string $column_name, $value): array {
        $query = "SELECT * FROM $table_name WHERE $column_name = :value";

        $action = (new Connection())->openConnection()->prepare($query);
        $action->bindParam(':value', $value);
        $action->execute();

        return $action->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getRaw($sql){
        return (new Connection())->getWEREData(new static(),$sql);
    }

}
