<?php
function display_error($validation, $feild){
    if($validation->hasError($feild)){
        return $validation->getError($feild);
    }else{
        return false;
    }
}

function logout()
{
    // $session = \Config\Services::session();
    // $session->destroy();
    session()->destroy();
    return redirect()->to(base_url());
}
?>