<?php
namespace Simple\Session;

use Simple\Database\Adaptor;

class DatabaseSessionHandler implements \SessionHandlerInterface
{
    public function open($savePath, $sessionName) {
        return true;
    }

    public function close() {
        return true;
    }

    public function read($id) {
        $data = current(Adaptor::getAll('SELECT * FROM session WHERE `id` = ?', [$id]));

        if($data) return $data->payload;

        Adaptor::exec('INSERT INTO session(`id`) VALUES(?)', [$id]);
        return '';
    }

    public function write($id, $payload) {
        return Adaptor::exec('UPDATE session SET `payload` = ? WHERE `id` = ?', [$payload, $id]);
    }

    public function destroy($id) {
        return Adaptor::exec('DELETE FROM session WHERE `id` = ?', [$id]);
    }

    public function gc($maxlifetime) {
        if($sessions = Adaptor::getAll('SELECT * FROM session')) {
            foreach ($sessions as $session) {
                $timestamp = strtotime($session->created_at);
                if(time() - $timestamp > $maxlifetime) {
                    $this->destroy($session->id);
                }
            }
            return true;
        }
        return false;
    }
}