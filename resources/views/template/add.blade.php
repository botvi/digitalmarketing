@extends('template.layout')

@section('content')
<div class="page-heading">
    <h3>Profile Statistics</h3>
</div>
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Basic Inputs</h4>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="basicInput">Basic Input</label>
                        <input type="text" class="form-control" id="basicInput"
                            placeholder="Enter email">
                    </div>

                    <div class="form-group">
                        <label for="helpInputTop">Input text with help</label>
                        <small class="text-muted">eg.<i>someone@example.com</i></small>
                        <input type="text" class="form-control" id="helpInputTop">
                    </div>

                    <div class="form-group">
                        <label for="helperText">With Helper Text</label>
                        <input type="text" id="helperText" class="form-control" placeholder="Name">
                        <p><small class="text-muted">Find helper text here for given textbox.</small>
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="disabledInput">Disabled Input</label>
                        <input type="text" class="form-control" id="disabledInput"
                            placeholder="Disabled Text" disabled>
                    </div>
                    <div class="form-group">
                        <label for="disabledInput">Readonly Input</label>
                        <input type="text" class="form-control" id="readonlyInput" readonly="readonly"
                            value="You can't update me :P">
                    </div>

                    <div class="form-group">
                        <label for="disabledInput">Static Text</label>
                        <p class="form-control-static" id="staticInput">email@mazer.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection