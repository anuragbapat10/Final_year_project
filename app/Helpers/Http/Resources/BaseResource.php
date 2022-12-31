<?php

namespace App\Helpers\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class BaseResource
 * @package App\Helpers\Http\Resources
 */
class BaseResource extends JsonResource
{

    /**
     * @var string|null
     */
    protected ?string $successMessage;

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function toResponse($request)
    {
        if (empty($this->successMessage)) {
            switch ($request->getMethod()) {
                case 'POST':
                case 'PUT':
                case 'PATCH':
                {
                    $this->successMessage = 'Saved Successfully!';
                    break;
                }
                case 'DELETE' :
                {
                    $this->successMessage = 'Deleted Successfully!';
                    break;
                }
                default:
                {
                    $this->successMessage = null;
                    break;
                }
            }
        }

        if (!empty($this->successMessage)) {
            $this->additional([
                'success' => true,
                'message' => $this->successMessage,
            ]);
        }

        return parent::toResponse($request);
    }

    /**
     * @param string $message
     *
     * @return $this
     */
    public function successMessage(string $message): static
    {
        $this->successMessage = $message;

        return $this;
    }
}