<?php
class Animal {
    public $animals = ["kucing","harimau", "kelinci", "buaya", "ular"];

    function index(){
        echo "<ol>";
        foreach($this->animals as $key => $value){
            echo "<li>$value</li>";
        }
        echo "</ol>";
    }
    function store($hewan){
        array_push($this->animals, $hewan);

        $this->index();
    }
    public function update($key, $value)
    {
        if (isset($this->animals[$key])){
            $this->animals[$key] = $value;
            // Memanggil methode index
            $this->index();
            } else{
                echo "hewan tidak ditemukan";
    
            }
    }
    public function destroy($key){
        if (isset($this->animals[$key])){
            unset($this->animals[$key] );
            // Memanggil methode index
            $this->index();
            } else{
                echo "hewan tidak ditemukan";
    
            }
    }
}

$hewan = new Animal();
echo "idex - menampilkan seluruh data Hewan <br>";
$hewan->index();
echo "<br>";

echo "store-Menambahkan data hewan baru (burung) <br>";
$hewan->store("burung");
echo"<br>";

echo "update- mengubah data hewan<br>";
$hewan->update(0,"kucing");
echo "<br>";

echo "destroy- menghapus data hewan<br>";
$hewan->destroy(0);
echo "<br>";
?>