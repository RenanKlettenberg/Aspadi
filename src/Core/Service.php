<?
namespace Core;

//Responsabilidade: Orquestrar o que deve ser feito (incluindo validar regras de negócio)
abstract class Service
{
    protected Repository $repository;
    public function getAll()
    {
        return $this->repository->getAll();
    }
    public function getById($id)
    {
        return $this->repository->getById($id);
    }

    public function insert($params)
    {
        $model = $this->repository->getModel();
        $validacao = $model->validarCampos($params);
        if ($validacao !== true) {
            throw new ErroInterno("Os campos não passaram na validação da model.", $validacao);
        }

        $id = $this->repository->insert($params);
        if (empty($id)) {
            throw new ErroInterno("O ID do registro não foi retornado.", ResponseCode::FALHA_AO_INSERIR);
        }

        return $id;
    }

    public function update($params, $id)
    {
        $model = $this->repository->getModel();
        $validacao = $model->validarCampos($params, []);
        if ($validacao !== true) {
            throw new ErroInterno("Os campos não passaram na validação da model.", $validacao);
        }

        $rows = $this->repository->update($params, $id);
        if (empty($rows)) {
            throw new ErroInterno("Nenhum registro no banco de dados foi afetado pelo update.", ResponseCode::FALHA_AO_ATUALIZAR);
        }

        return $rows;
    }

    public function delete($id)
    {
        $rows = $this->repository->delete($id);
        if (empty($rows)) {
            throw new ErroInterno("Nenhum registro no banco de dados foi afetado pelo delete.", ResponseCode::FALHA_AO_DELETAR);
        }

        return $rows;
    }
}