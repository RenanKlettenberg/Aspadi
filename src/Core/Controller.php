<?
namespace Core;

//Responsabilidade: Recepcionar as requisições HTTP e lidar com os erros das camadas inferiores
abstract class Controller
{
    protected Service $service;

    public function getAll()
    {
        try {
            Presenter::encerrar($this->service->getAll());
        } catch (\Throwable $e) {
            Presenter::handleException($e, ResponseCode::FALHA_AO_BUSCAR_DADOS);
        }
    }
    public function getById($id)
    {
        try {
            Presenter::encerrar($this->service->getById($id));
        } catch (\Throwable $e) {
            Presenter::handleException($e, ResponseCode::FALHA_AO_BUSCAR_DADOS);
        }
    }
    public function insert()
    {
        try {
            Presenter::encerrar($this->service->insert($_POST));
        } catch (\Throwable $e) {
            Presenter::handleException($e, ResponseCode::FALHA_AO_INSERIR);
        }
    }
    public function update($id)
    {
        try {
            Presenter::encerrar($this->service->update($_POST, $id));
        } catch (\Throwable $e) {
            Presenter::handleException($e, ResponseCode::FALHA_AO_ATUALIZAR);
        }
    }
    public function delete($id)
    {
        try {
            Presenter::encerrar($this->service->delete($id));
        } catch (\Throwable $e) {
            Presenter::handleException($e, ResponseCode::FALHA_AO_DELETAR);
        }
    }
}