<?PHP
function sendMessage() {
    $title      = array(
        "en" => $_GET['title']
    );
    $content      = array(
        "en" => $_GET['message']
    );
    $fields = array(
        'app_id' => "8f8f6e28-4727-414a-8b16-5d8b4bb55103",
        'included_segments' => array(
            'All'
        ),
        'data' => array(
            "foo" => "bar"
        ),
        'headings' => $title,
        'contents' => $content,
        'web_buttons' => $hashes_array,
        'big_picture' => $_GET['big_image']
    );
    
    $fields = json_encode($fields);
    print("
JSON sent:
");
    print($fields);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charset=utf-8',
        'Authorization: Basic NTllMjM5M2UtNGY0NS00ZWU1LTkxNmEtNzJiYmU5ODA4NWNl'
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    return $response;
}

$response = sendMessage();
$return["allresponses"] = $response;
$return = json_encode($return);

$data = json_decode($response, true);
print_r($data);
$id = $data['id'];
print_r($id);

print("

JSON received:
");
print($return);
print("
");
?>
