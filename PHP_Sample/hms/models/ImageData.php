<?php 

class ImageData
{
    const TABLE_NAME = 'images';
    private $dbConnect;

    public function __construct()
    {
        $dbConnect = new dbConnect();
        $this->dbConnect = $dbConnect->connect();
    }

    public function addImage($details)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("INSERT INTO $table(id,admin_image) VALUES(?,?)");
        $stmt->execute([$details['id'],$details['admin_image']]);
    }

    public function deleteImage($details)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("DELETE FROM $table WHERE id=?");
        $stmt->execute([$details['id']]);
    }

    public function selectImage($id)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT * FROM $table WHERE id = ?");
        $stmt->execute([$id]);
        $record = $stmt->fetch();
        return $record['admin_image'];
    }

    public function addDoctorImage($details)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("INSERT INTO $table(id,doctor_image) VALUES(?,?)");
        $stmt->execute([$details['id'],$details['doctor_image']]);
    }

    public function deleteDoctorImage($details)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("DELETE FROM $table WHERE id=?");
        $stmt->execute([$details['id']]);
    }

    public function selectDoctorImage($id)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT * FROM $table WHERE id = ?");
        $stmt->execute([$id]);
        $record = $stmt->fetch();
        return $record['doctor_image'];
    }

    public function addPatientImage($details)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("INSERT INTO $table(id,patient_image) VALUES(?,?)");
        $stmt->execute([$details['id'],$details['patient_image']]);
    }

    public function deletePatientImage($details)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("DELETE FROM $table WHERE id=?");
        $stmt->execute([$details['id']]);
    }

    public function selectPatientImage($id)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT * FROM $table WHERE id = ?");
        $stmt->execute([$id]);
        $record = $stmt->fetch();
        return $record['patient_image'];
    }

    public function addStaffImage($details)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("INSERT INTO $table(id,staff_image) VALUES(?,?)");
        $stmt->execute([$details['id'],$details['staff_image']]);
    }

    public function deleteStaffImage($details)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("DELETE FROM $table WHERE id=?");
        $stmt->execute([$details['id']]);
    }

    public function selectStaffImage($id)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT * FROM $table WHERE id = ?");
        $stmt->execute([$id]);
        $record = $stmt->fetch();
        return $record['staff_image'];
    }
}