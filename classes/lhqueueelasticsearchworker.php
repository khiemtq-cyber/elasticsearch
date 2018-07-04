<?php

/**
 * Example of worker usage
 * 
 * */
class erLhcoreClassElasticSearchWorker {
     
    public function perform()
    {
        $db = ezcDbInstance::get();
        $db->reconnect(); // Because it timeouts automatically, this calls to reconnect to database, this is implemented in 2.52v

        $db->beginTransaction();
        try {
            $stmt = $db->prepare('SELECT chat_id FROM lhc_lheschat_index WHERE status = 0 LIMIT :limit FOR UPDATE ');
            $stmt->bindValue(':limit',100,PDO::PARAM_INT);
            $stmt->execute();
            $chatsId = $stmt->fetchAll(PDO::FETCH_COLUMN);
        } catch (Exception $e) {
            error_log($e->getMessage() . "\n" . $e->getTraceAsString());
            return;
        }

        if (!empty($chatsId)) {
            // Delete indexed chat's records
            $stmt = $db->prepare('UPDATE lhc_lheschat_index SET status = 1 WHERE chat_id IN (' . implode(',', $chatsId) . ')');
            $stmt->execute();
            $db->commit();

            $chats = erLhcoreClassModelChat::getList(array('filterin' => array('id' => $chatsId)));

            if (!empty($chats)) {
                try {
                    erLhcoreClassElasticSearchIndex::indexChats(array('chats' => $chats));
                } catch (Exception $e) {
                    error_log($e->getMessage() . "\n" . $e->getTraceAsString());
                    return;
                }
            }

            $stmt = $db->prepare('DELETE FROM lhc_lheschat_index WHERE chat_id IN (' . implode(',', $chatsId) . ')');
            $stmt->execute();

        } else {
            $db->rollback();
        }

        if (count($chatsId) == 100) {
            erLhcoreClassModule::getExtensionInstance('erLhcoreClassExtensionLhcphpresque')->enqueue('lhc_elastic_queue', 'erLhcoreClassElasticSearchWorker', array());
        }
    }
}

?>