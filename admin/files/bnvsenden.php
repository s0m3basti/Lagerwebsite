<?php
    require "../../Datenbank/writer.php";
    require '../../files/linkmaker.php';
    require '../../files/datenzugriff.php';

    session_start();
    if(!isset($_SESSION['userid'])) {
        header("Location: ../../login.php?er=1");
    }

    if($_GET['new'] == 1){
        $username = $_POST['username'];
        $vorname = $_POST['firstname'];
        $nachname = $_POST['surname'];
        $email = $_POST['email'];
        $rechte = $_POST['rights'];
        $passwort1= $_POST['password1'];
        $passwort2= $_POST['password2'];
        $pwset = false;

        if($passwort1 != $passwort2){
            header("Location:../benutzerverwaltung.php?new=1&message=8");
        }
        else{
            try{
                $db = new PDO("$host; $name" ,$user,$pass);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $passwort = $passwort1;
                $passwort = password_hash($passwort, PASSWORD_DEFAULT);

                $sql_einfügen = "INSERT INTO login (id, user_name, password, pwset, firstname, surname, email, rights) 
                                    VALUES ('', :username, :passwort,:pwset, :vorname, :nachname, :email, :rechte)";
                                
                $stmt_t = $db->prepare($sql_einfügen);
                $stmt_t->bindValue(':username', $username);
                $stmt_t->bindValue(':passwort', $passwort);
                $stmt_t->bindValue(':pwset', $pwset);
                $stmt_t->bindValue(':vorname', $vorname);
                $stmt_t->bindValue(':nachname', $nachname);
                $stmt_t->bindValue(':email', $email);
                $stmt_t->bindValue(':rechte', $rechte);

                $stmt_t->execute();

                require 'bnv_mail.php';

                header("Location:../benutzerverwaltung.php?message=3");
            }
            catch(PDOException $e){
                $fehler = $e->getMessage();
                header("Location:../benutzerverwaltung.php?message=4");
            }
            finally{
                $db = null;
            }
        }
    }
    else{
        if($_GET['new'] == 2){

            $id = $_GET['id'];
            $username = $_POST['username'];
            $vorname = $_POST['firstname'];
            $nachname = $_POST['surname'];
            $email = $_POST['email'];
            $rechte = $_POST['rights'];
            $passwort= $_POST['passwort'];

            if($passwort == "on"){
                $pwset = false; 
                try{
                    $db = new PDO("$host; $name" ,$user,$pass);
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $sql = $sql = 'UPDATE login SET user_name = "'.$username.'", firstname = "'.$vorname.'", surname = "'.$nachname.'", email = "'.$email.'", rights = "'.$rechte.'", pwset = "'.$pwset.'" WHERE id = "'.$id.'";';
                                    
                    $stmt = $db->prepare($sql);
                    $stmt->execute();

                    header("Location:../benutzerverwaltung.php?message=5");
                }
                catch(PDOException $e){
                    $fehler = $e->getMessage();
                    echo $fehler;
                    header("Location:../benutzerverwaltung.php?message=6");
                }
                finally{
                    $db = null;
                }
            }
            else{
                try{
                    $db = new PDO("$host; $name" ,$user,$pass);
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $sql = 'UPDATE login SET user_name = "'.$username.'", firstname = "'.$vorname.'", surname = "'.$nachname.'", email = "'.$email.'", rights = "'.$rechte.'" WHERE id = "'.$id.'";';
                                    
                    $stmt = $db->prepare($sql);
                    $stmt->execute();

                    header("Location:../benutzerverwaltung.php?message=5");
                }
                catch(PDOException $e){
                    $fehler = $e->getMessage();
                    echo $fehler;
                    header("Location:../benutzerverwaltung.php?message=6");
                }
                finally{
                    $db = null;
                }
            }
            
        }
        else{
            if($_GET['new'] == 3){

                $id = $_SESSION['userid'];
                $passwort1= $_POST['password1'];
                $passwort2= $_POST['password2'];

                if($passwort1 != $passwort2){
                    header("Location:../pwset.php?message=1");
                }
                else{
                    try{
                        $db = new PDO("$host; $name" ,$user,$pass);
                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
                        $passwort = $passwort1;
                        $pwset = true;
                        $passwort = password_hash($passwort, PASSWORD_DEFAULT);
        
                        $sql = 'UPDATE login
                                SET password = "'.$passwort.'", pwset = "'.$pwset.'"
                                WHERE id = "'.$id.'" ';
                                        
                        $stmt = $db->prepare($sql);
                        $stmt->bindValue(':passwort', $passwort);
                        $stmt->bindValue(':pwset', $pwset);
                        $stmt->execute();
        
                        header("Location:../index.php");
                    }
                    catch(PDOException $e){
                        $fehler = $e->getMessage();
                        header("Location:../pwset.php?message=2error=$fehler");
                    }
                    finally{
                        $db = null;
                    }
                }
            }
            else{
                header("Location:../benutzerverwaltung.php?message=7");
            }
        }   

    }
?>