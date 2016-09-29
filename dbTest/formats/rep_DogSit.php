<?php
    $servername = "mysql.servicedogsva.org";
    $username = "ked9ua";
    $password = "M!kado2014";
    $dbname = "sdvrec";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    //Pull form info
    $sql = "SELECT * FROM Rep_DogSit LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output form data
        $rsp = $result->fetch_assoc();
    } else {
        echo "Form Submission not found!";
    }
?>
<html>
<style>
    textarea {font-family:serif; display:none;}
</style>
<script>
    function obs(nm) {
        document.write("<input onchange='disp(\"" + nm + "\")' name=" + nm + " id=" + nm + "Y type=radio value=yes>Yes <input onchange='disp(\"" + nm + "\")' name=" + nm + " id=" + nm + "N type=radio value=no>No<br><textarea name=" + nm + "D id=" + nm + "D placeholder='If yes, please describe.'></textarea>");
        }

    function disp(nm) {
       var x = document.getElementById(nm + "Y").checked;
       if (x) document.getElementById(nm + "D").style.display = "block";
       else document.getElementById(nm + "D").style.display = "none";
}
</script>
<body><form action=rep_DogSit.php method=POST>
<b>Dog Sitting Questionnare</b><br>
<p>
    <b><?php echo $rsp["dogName"]; ?></b><br>
    How long was the dog with you? <input name=visitLength><br>
</p>
<hr>
<p>
    Did you observe any:<ul>
        <li>Excessive barking? <script>obs("excessBark");</script></li>
        <li>Separation anxiety? <script>obs("sepAnx");</script></li>
        <li>Destructiveness? <script>obs("destruct");</script></li>
        <li>Resource guarding? <script>obs("resGuard");</script></li>
        <li>Jumping? <script>obs("jump");</script></li>
        <li>Housebreaking issues? <script>obs("hbrkProb");</script></li>
        <li>Counter surfing? <script>obs("surf");</script></li>
        <li>Good or poor meet and greets? <input name=mG type=radio value=good> Good <input name=mG type=radio value=poor> Poor<br><textarea name=mGD style=display:block; placeholder="Please describe."></textarea></li>
    </ul>
    Can you tell us things the dog did well in the home environment?<br>
    <textarea name=posHome style=display:block;></textarea>
</p>
<hr>
<p>
    Did you take the dog out in public? <input onchange='disp("pub");' name=pub id=pubY type=radio value=yes> Yes <input onchange='disp("pub");' name=pub id=pubN type=radio value=no> No<br>
    <div id=pubD>If yes, did you observe any:<ul>
        <li>Pulling on leash? <script>obs("pubPull");</script></li>
        <li>Inability to follow cues? <script>obs("pubBadCues");</script></li>
        <li>Jumping? <script>obs("pubJump");</script></li>
        <li>Barking at other dogs? <script>obs("pubBark");</script></li>
        <li>Trouble getting in or out of the car? <script>obs("pubCar");</script></li>
        <li>Good or poor meet and greets? <input name=pubMG type=radio value=good> Good <input name=pubMG type=radio value=poor> Poor<br><textarea name=pubMGD style=display:block; placeholder="Please describe."></textarea></li>
    </ul>
    Can you describe things the dog did well when taking him out in public?<br>
    <textarea name=posPublic style=display:block;></textarea></div>
</p>
<hr>
<p>
    In general, did the dog have good house manners? <input onchange='disp("hsManners");' id=hsMannersN name=hsManners type=radio value=yes> Yes <input onchange='disp("hsManners");' id=hsMannersY name=hsManners type=radio value=no> No<br>
    <textarea name=hsMannersD id=hsMannersD></textarea><br>
    In general, did the dog have good public manners? <input onchange='disp("pubManners");' id=pubMannersN name=pubManners type=radio value=yes> Yes <input onchange='disp("pubManners");' id=pubMannersY name=pubManners type=radio value=no> No<br>
    <textarea name=pubMannersD id=pubMannersD></textarea><br>
    Based on the survey you were given before you got the dog, were there any surprises in the dog's behavior? <input onchange='disp("surprises");' id=surprisesY name=surprises type=radio value=yes> Yes <input onchange='disp("surprises");' id=surprisesN name=suprises type=radio value=no> No<br>
    <textarea name=surprisesD id=surprisesD></textarea><br>
    If the dog was an amazing genius, please describe.<br>
    <textarea name=genius style=display:block;></textarea>
</p>
<hr>
<p>
    Did you enjoy this dog? <input name=enjoy><br>
    Would you watch this dog again? <input name=takeAgain type=radio value=yes> Yes <input name=takeAgain type=radio value=no> No<br>
    Please let us know anything else you think we should know.<br>
    <textarea name=comments style=display:block;></textarea>
</p>
<input type=submit value=Submit>
</form></body></html>