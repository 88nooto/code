</br>
</br>Hello hello, World!</br>

<?php 


echo'</br>-------------------------------------------------------------</br>';
//codeigniter随机密匙生成
$key = bin2hex($this->encryption->create_key(16));
//$key = hex2bin($key);
echo  "(".$key.")";

echo'</br>-----------------------------用户名加密--------------------------------</br>';
//codeigniter加密类
$this->encryption->initialize(//加密算法，模式，key配置。
    array(
        'cipher' => 'aes-256',
        'mode' => 'ecb',
        
        
    )
);

$plain_text = 'admin';
$ciphertext = $this->encryption->encrypt($plain_text);
//加密
echo  $ciphertext."</br>";

$a = $this->encryption->decrypt($ciphertext);
//解密
echo $a;

//-------------------------------------------------


echo'</br>-------------------------------------------------------------</br>';
//mcrypt随机盐值hash
$size = mcrypt_get_iv_size(MCRYPT_CAST_256, MCRYPT_MODE_CFB);
$iv = mcrypt_create_iv($size, MCRYPT_DEV_RANDOM);

echo '</br>'.$iv.'</br>';

echo password_hash($iv, PASSWORD_DEFAULT)."</br>";


echo'</br>-------------------------------------------------------------</br>';
//mcrypt加密拓展

$setret_data = 'un_one';
$setret_key = '05fd99b840ed3f125ac99967730d18a2';

/* 打开加密算法和模式 */
$td = mcrypt_module_open(MCRYPT_CAST_256, '', MCRYPT_MODE_CFB, '');

/* 创建初始向量，并且检测密钥长度。 */
$iv = substr($setret_key, 0, mcrypt_enc_get_iv_size($td)); 		//mcrypt_enc_get_iv_size($td) = '16';

/* 创建密钥 */
$key = $setret_key;

/* 初始化加密 */
mcrypt_generic_init($td, $key, $iv);

/* 加密数据 */
$encrypted = mcrypt_generic($td, $setret_data);

/* 结束加密，执行清理工作 */
mcrypt_generic_deinit($td);

//--------------

/* 初始化解密模块 */
mcrypt_generic_init($td, $key, $iv);

/* 解密数据 */
$decrypted = mdecrypt_generic($td, $encrypted);

/* 结束解密，执行清理工作，并且关闭模块 */
mcrypt_generic_deinit($td);
mcrypt_module_close($td);

/* 显示文本 */
echo $encrypted . "</br>";

echo trim($decrypted) . "</br>";

echo'</br>-------------------------------------------------------------</br>';
//hash拓展
print_r(hash_algos());




echo'</br>-----------------------------CSPRNG 函数 salt盐值--------------------------------</br>';
//CSPRNG 函数 
//require_once "D:/Construction/Running/wamp/extended/random_compat-2.0.2/lib/random.php"; //PHP 5.5需要导入random_compat拓展库，php7.0已内置

$num = random_int(16,24);
$bytes = bin2hex(random_bytes($num));
var_dump($bytes);
echo $bytes;


echo'</br>------------------------------password_hash-------------------------------</br>';
//php内置password_hash拓展

$pw = 'admin';
$pw = $pw.$bytes;

$options = [
    'cost' => 11
];
$ph = password_hash($pw, PASSWORD_DEFAULT,$options);
$ph = substr($ph,7,strlen($ph));


$ph = substr($bytes, 0,20).$ph.substr($bytes, 20,strlen($bytes));

echo "'".$ph."'</br>";
echo strlen($ph).'</br>';


echo'</br>-----------------------------</br>';
//$hash = '$2y$11$'.$ph;
//$salt = $bytes;
//$pp = '123456'.$salt;
$pw2 = 'admin';
$hash = '$2y$11$'.substr($ph,20,53);
$salt = substr($ph, 0,20).substr($ph, 73,strlen($ph));
$pp = $pw2.$salt;


if (password_verify($pp, $hash)) {
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
}

echo'</br>-----------------------------password_hash end--------------------------------</br>';

//------------------------------------------------------------------------

echo '</br>'.substr('123456',4,2);
//$ct = mcrypt_generic($td, $iv);
//
//echo '</br>'.$ct;

echo '</br>';

echo base_url("assets/css/mainframe.css");

echo'</br>-----------------------------temp--------------------------------</br>';

 		$a = array("3");
echo $a[0];
		//$data['tr_class'] = array("","success","warning","info");
		//$this->load->view('templates/admin_user_manage',$data);

?>