<?php
include "components/navbar.php";
include "functions/chatFunctions.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.4/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>title</title>
</head>

<body class="min-h-screen" data-theme='<?php echo $_SESSION["theme"] ?>'>
    <?php
    if(!isset($_SESSION["login"])){
        header('location: login.php');
    }

    $user = $_SESSION["login"];
    
    if (isset($_POST["knopVerwijder"])) {
        $chatid = $_POST["chatid"];
        deletechat($mysqli, $chatid);
        header("Location: berichten.php");
    }

    ?>
    <div class="overflow-x-auto max-w-2xl mx-auto p-3">
    <table class="table bg-white shadow-lg">
        <thead>
            <tr>
                <th class="text-left"><?=__('Profile')?></th>
                <th class="text-left"><?=__('Name')?></th>
                <th class="text-center"><?=__('Message')?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if(!(getChatData($mysqli, $user))) {
                echo "
                <tr>
                    <td colspan=4>U hebt geen berichten.</td>
                </tr> 
                ";
            } else {
                foreach(getChatData($mysqli, $user) as $row) {
                    ($row["zenderid"] == $_SESSION["login"])
                    ?$otherUserid = $row["ontvangerid"]
                    :$otherUserid = $row["zenderid"];
                    $foto = getProfilePicture($mysqli,$otherUserid);
                    $dataOtherUser = getUser($mysqli, $otherUserid);
                    $message = getLastMessage($mysqli, $row["gesprekid"]);
                    echo "
                    <tr>
                        <div>
                            <td>
                                <div class='flex items-center space-x-3'>
                                    <div class='avatar'>
                                        <div class='mask mask-squircle w-16 h-16'>
                                            <img src='../public/img/".$foto."' alt='".$foto."'/>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class='text-left'>
                                <div>
                                    <div class='font-bold'>".$dataOtherUser[0]['voornaam']." ".$dataOtherUser[0]['naam']."</div>
                                </div>
                            </td>
                            <td class= 'text-center'>
                                <div>
                                <div class='text-sm opacity-50'>".$message."</div>
                                </div>
                            </td>
                            <td class='text-right'>
                                <a href=".$row['link'].">   
                                    <button class='btn btn-primary btn-sm'>".__('Chat')."</button>
                                </a>
                            </td>
                            <form method='post' action='berichten.php'>
                                <input type='hidden' name='chatid' value='".$row['gesprekid']."'>
                                <td class='text-right'>
                                    <button name='knopVerwijder' class='btn btn-sm btn-circle btn-ghost'>✕</button>
                                </td>
                            </form>
                    </tr>";
                }
            }
            ?>
        </tbody>
    </table>
</div>
</body>

</html> 