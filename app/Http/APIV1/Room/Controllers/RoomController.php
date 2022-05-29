<?php

namespace App\Http\APIV1\Room\Controllers;

use App\Domain\Rooms\Actions\GetAllRooms;
use App\Http\APIV1\Room\Resources\RoomCollection;
use App\Http\APIV1\Common\ErrorJsonResource;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RoomController extends Controller
{
    public function getAll()
    {
        $result = [];
        $return = null;
        $action = new GetAllRooms();
        try {
            $result['data'] = $action->execute();
            $return = (new RoomCollection($result['data']))->response()->setStatusCode(200);
        }
        catch (ModelNotFoundException $e) {
            $return['error'] = new ErrorJsonResource(404, $e->getMessage());
            $return->response()->setStatusCode(404);
        }
        catch (\Exception $e) {
            $return['error'] = new ErrorJsonResource($e);
        }
        return $return;
    }
}