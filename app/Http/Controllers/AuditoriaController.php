<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAuditoriaRequest;
use App\Http\Requests\UpdateAuditoriaRequest;
use App\Repositories\AuditoriaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Auditoria;
use App\Models\General\Main;
use App\Classes\MainClass;
use Flash;
use Response;

class AuditoriaController extends AppBaseController
{
    /** @var  AuditoriaRepository */
    private $auditoriaRepository;

    public function __construct(AuditoriaRepository $auditoriaRepo)
    {
        $this->auditoriaRepository = $auditoriaRepo->with('userModified');
    }

    /**
     * Display a listing of the OfficeVirtual.
     *
     * @param Request $request
     *
     * @return Response
     */
     public function getAuditoria(Request $request)
     {
       $auditoria = Auditoria::with('userModified')->get();

       return response()->json([
         'data' => $auditoria,
       ]);
      }
    public function index(Request $request)
    {
      $main = new MainClass();
      $main = $main->getMain();

        $auditoria = $this->auditoriaRepository->all();

        return view('auditoria.index')
        ->with('main', $main)
        ->with('auditoria', $auditoria);
    }

    /**
     * Show the form for creating a new OfficeVirtual.
     *
     * @return Response
     */
    public function create()
    {
      $main = new MainClass();
      $main = $main->getMain();

        return view('auditoria.create', compact('main'));
    }

    /**
     * Store a newly created OfficeVirtual in storage.
     *
     * @param CreateAuditoriaRequest $request
     *
     * @return Response
     */
    public function store(CreateAuditoriaRequest $request)
    {
      $input = $request->all();

        $auditoria = $this->auditoriaRepository->create($input);

      return redirect(route('auditoria.index'));
    }

    /**
     * Display the specified OfficeVirtual.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
      $main = new MainClass();
      $main = $main->getMain();

        $auditoria = $this->auditoriaRepository->with('userModified')->find($id);

        if (empty($auditoria)) {
            // Flash::error('Office Virtual not found');

            return redirect(route('auditoria.index'));
        }

        return view('auditoria.show')
        ->with('main', $main)
        ->with('auditoria', $auditoria);
    }

    /**
     * Show the form for editing the specified OfficeVirtual.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
      $main = new MainClass();
      $main = $main->getMain();

        $auditoria = $this->auditoriaRepository->find($id);

        if (empty($auditoria)) {
            // Flash::error('Office Virtual not found');

            return redirect(route('auditoria.index'));
        }

        return view('auditoria.edit')
        ->with('main', $main)
        ->with('auditoria', $auditoria);
    }

    /**
     * Update the specified OfficeVirtual in storage.
     *
     * @param int $id
     * @param UpdateAuditoriaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAuditoriaRequest $request)
    {
        $auditoria = $this->auditoriaRepository->find($id);

        if (empty($auditoria)) {
            // Flash::error('Office Virtual not found');

            return redirect(route('auditoria.index'));
        }

        $auditoria = $this->auditoriaRepository->update($request->all(), $id);

        // Flash::success('Office Virtual updated successfully.');

        return redirect(route('auditoria.index'));
    }

    /**
     * Remove the specified OfficeVirtual from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $auditoria = $this->auditoriaRepository->find($id);

        if (empty($auditoria)) {
            // Flash::error('Office Virtual not found');

            return redirect(route('auditoria.index'));
        }

        $this->auditoriaRepository->delete($id);

        // Flash::success('Office Virtual deleted successfully.');

        return redirect(route('auditoria.index'));
    }

}
