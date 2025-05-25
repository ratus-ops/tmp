<?php
$ip = $_GET['ip'] ?? '';
$isp = $_GET['isp'] ?? '';

if ($ip && $isp) {
    $configPath = 'configs.json';
    $configs = json_decode(file_get_contents($configPath), true);

    $configs['banned'] = $configs['banned'] ?? [];

    // Vérifie si l'IP est déjà dans la liste
    $alreadyBanned = false;
    foreach ($configs['banned'] as $entry) {
        if (isset($entry['ip']) && $entry['ip'] === $ip) {
            $alreadyBanned = true;
            break;
        }
    }

    if (!$alreadyBanned) {
        $configs['banned'][] = [
            'ip' => $ip,
            'isp' => $isp,
            'date' => date('Y-m-d H:i:s')
        ];
        file_put_contents($configPath, json_encode($configs, JSON_PRETTY_PRINT));
        echo "🚫 IP $ip bannie.";
    } else {
        echo "IP déjà bannie.";
    }
} else {
    echo "Paramètres manquants.";
}
