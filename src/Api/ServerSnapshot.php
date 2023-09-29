<?php
namespace Webdock\Api;
use Webdock\BaseApi;
use Webdock\Entity\ServerActionSnapshotModel;

class ServerSnapshot extends BaseApi
{
    protected $endpoint = 'servers/%s/snapshots';

    public function list($serverSlug)
    {
        $endpoint = sprintf($this->endpoint, $serverSlug);
        return $this->execute($endpoint, 'GET', []);
    }

    public function get($serverSlug, $snapshotId)
    {
        $endpoint = implode('/', [
            sprintf($this->endpoint, $serverSlug),
            $snapshotId,
        ]);
        return $this->execute($endpoint, 'GET', []);
    }

    public function delete($serverSlug, $snapshotId)
    {
        $endpoint = implode('/', [
            sprintf($this->endpoint, $serverSlug),
            $snapshotId,
        ]);
        return $this->execute($endpoint, 'DELETE', []);
    }

    public function create($serverSlug, $snapshotName)
    {

        $endpoint = sprintf($this->endpoint, $serverSlug);
        $model = new ServerActionSnapshotModel([
            'name' => $snapshotName
        ]);
        $params = ['form_params' => $model->toArray()];

        return $this->execute($endpoint, 'POST', $params);

    }
}
