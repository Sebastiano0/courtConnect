function makeRequest(event, user_id) {
    console.log(event);
    console.log(user_id);

    let formData = new FormData();
    formData.append("event_id", event);
    formData.append("user_id", user_id);
    formData.append("state", 2);

    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../api/insert_request.php");
    xhttp.onreadystatechange = async function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == "1") {
            } else {
                console.log(this.responseText);
            }
        }
    };

    xhttp.send(formData);
}