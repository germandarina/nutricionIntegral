<?php

namespace App\Models\Auth\Traits\Attribute;

/**
 * Trait RoleAttribute.
 */
trait RoleAttribute
{
    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        return '<a href="'.route('admin.auth.role.edit', $this).'" class="btn btn-primary"><i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.edit').'"></i></a>';
    }
    /**
     * @return string
     */
    public function getConfirmedButtonAttribute()
    {
        if (! config('access.users.requires_approval')) {
            return '<a href="'.route('admin.auth.user.account.confirm.resend', $this).'" class="dropdown-item">'.__('buttons.backend.access.users.resend_email').'</a> ';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        return '<a href="'.route('admin.auth.role.destroy', $this).'"
			 data-method="delete"
			 data-trans-button-cancel="'.__('buttons.general.cancel').'"
			 data-trans-button-confirm="'.__('buttons.general.crud.delete').'"
			 data-trans-title="'.__('strings.backend.general.are_you_sure').'"
			 name="confirm_item" 
			 class="btn btn-danger"><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.delete').'"></i></a> ';
    }

    /**
     * @return string
     */
    public function getDeletePermanentlyButtonAttribute()
    {
        return '<a href="'.route('admin.auth.role.delete-permanently', $this).'" name="confirm_item" class="btn btn-danger btn-sm"><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="'.__('buttons.backend.access.users.delete_permanently').'"></i></a> ';
    }

    /**
     * @return string
     */
    public function getRestoreButtonAttribute()
    {
        return '<a href="'.route('admin.auth.role.restore', $this).'" name="confirm_item" class="btn btn-info btn-sm"><i class="fas fa-sync" data-toggle="tooltip" data-placement="top" title="'.__('buttons.backend.access.users.restore_user').'"></i></a> ';
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        if ($this->id == 1) {
            return 'N/A';
        }

        if ($this->trashed()) {
            return "N/A";
//                '
//				<div class="btn-group btn-sm" role="group" aria-label="'.__('labels.backend.access.users.user_actions').'">
//				  '.$this->restore_button.'
//				  '.$this->delete_permanently_button.'
//				</div>';
        }else{
            return '<div class="btn-group btn-group-sm" role="group" aria-label="'.__('labels.backend.access.users.user_actions').'">
			  '.$this->edit_button.'
              '.$this->delete_button.' 			  
			</div>';
        }
    }
}
