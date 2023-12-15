<?php

/**
 * Connect to database
 */
function db()
{
    $host = "localhost";
    $database = "web_a";
    $user = "root";
    $password = "";

    try {
        $db =  new PDO("mysql:host=$host;dbname=$database", $user, $password);
        // set the PDO error mode to exception
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        // echo "Connection failed: " . $e->getMessage();
        return "";
    }
}


/**
 * Create new student record
 */
function createStudent($name, $age, $email, $image_url) //Biến ô input
{
    $db = db();
    $stmt = $db->prepare("INSERT INTO student (name, age, email, profile)VALUES(:name, :age, :email, :profile)"); //trường trong DB và biến gán giá trị
    $stmt->bindParam(':name',$name);
    $stmt->bindParam(':age',$age);
    $stmt->bindParam(':email',$email);
    $stmt->bindParam(':profile',$image_url);
    $stmt->execute();
    return $db->lastInsertId();
}

/**
 * Get all data from table student
 */
function selectAllStudents()
{
    $db = db();
    $stmt = $db->query("SELECT * FROM student");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Get only one on record by id 
 */
function selectOnestudent($id)
{
    $db = db();
    $stmt = $db->prepare("SELECT * FROM student WHERE id = :id");
    $stmt->execute([":id"=>$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

/**
 * Delete student by id
 */
function deleteStudent($id)
{
    $db = db();
    $stmt = $db->prepare("DELETE FROM student WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt;
}


/**
 * Update students
 * 
 */
function updateStudent($id, $name, $age, $email, $image_url){
    $db = db();
    $stmt = $db->prepare("UPDATE student SET name = :name,age = :age, email = :email, profile = :profile WHERE id = :id");
    $stmt->bindParam(':id',$id);
    $stmt->bindParam(':name',$name);
    $stmt->bindParam(':age',$age);
    $stmt->bindParam(':email',$email);
    $stmt->bindParam(':profile',$image_url);
    $stmt->execute();
    return $stmt;
}

