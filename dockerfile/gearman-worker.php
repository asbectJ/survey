<?php

echo "Starting\n";

# Create our worker object.
$gmworker= new GearmanWorker();

# Add default server (localhost).
$gmworker->addServer();

$gmworker->addFunction("other", 'handleUrl');

print "Waiting for job...\n";
while($gmworker->work())
{
  if ($gmworker->returnCode() != GEARMAN_SUCCESS)
  {
    echo "return_code: " . $gmworker->returnCode() . "\n";
    break;
  }
}

function handleUrl($job) {
    $data = json_decode($job->workload(), true);

    if (!($url = $data['data']['url'] ?? null)) {
        return;
    }

    //初始化
    $curl = curl_init();
    //设置抓取的url
    curl_setopt($curl, CURLOPT_URL, $url);
    //设置头文件的信息作为数据流输出
    curl_setopt($curl, CURLOPT_HEADER, 0);
    //设置获取的信息以文件流的形式返回，而不是直接输出。
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    //设置post方式提交
    // curl_setopt($curl, CURLOPT_POST, $method == 'POST');
    //设置post数据
    // if ($body = $data['body'] ?? null) {
    //     curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
    // }
    //执行命令
    curl_exec($curl);
    //关闭URL请求
    curl_close($curl);
}