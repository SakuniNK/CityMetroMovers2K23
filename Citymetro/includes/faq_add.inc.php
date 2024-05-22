<?php

require_once '../Classes/faq.php';
require '../Classes/DBConnector.php';
include '../message.php';
use Classes\faq;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST["submit"])) {
        if (!empty($_POST["topic"]) || !empty($_POST["message"])) {
            $box = $_POST["Box"];
            $topic = $_POST["topic"];
            $message = $_POST["message"];

            $faqadd = new faq();
            $faqadd->addFaq($box,$topic,$message);
                header("Location: ../moderatorindex.php");

        }
    } else {
        header("Location: ../faq_add.php?Didnt_post");
    }
} else {
    header("Location: ../faq_add.php?Didnt_post");
}