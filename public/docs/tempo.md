any model can have trait isTaskable.
task is created with task:create([<title, description,when_done(optional), model> or <template>],role name, staff id)
task template is create by admin of a model, specifying the (title, description and when_done)

at creation .... status is default to queue, if staff exist or role name has only 1 staff, staff ID is assigned and status is set as active.
at update .... status can be changed, and remarks for logging.

if task is status done, when_done is update for trigger to model to do next action