@extends('layouts.app')

@section('content')
    <ul class="nav nav-tabs" id="tabFamily" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="person-tab" data-toggle="tab"
               href="#person" role="tab" aria-controls="person"
               aria-selected="true">{{ __('family_settings/views.data_family_setting') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="type_person-tab" data-toggle="tab"
               href="#type_person_tab" role="tab" aria-controls="type_person"
               aria-selected="false">{{ __('types/people/views.type_people') }}</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabPeople">
        <form class="form" method="POST" action="{{ route('family_settings.update', ['id' => $family_setting->id]) }}">
            @method('PUT')
            @csrf
            @include('components.header')
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="rgi_id">{{ __('rgi/views.rgi') }} * {{ old('rgi_id') }}</label>
                    <select required class="custom-select" id="rgi_id" name="rgi_id"
                            value="{{ old('rgi_id') }}">
                        <option disabled value="0">{{ __('default/views.selectOption') }}</option>
                        @foreach($rgis as $rgi)
                            <option @if($family_setting->rgi_id == $rgi->id) selected="selected" @endif
                            value="{{ $rgi->id }}">{{ 'RGI: ' . $rgi->rgi_number . ' - '  . $rgi->address->street . ' - ' .
                            'Nº: ' . $rgi->number  }}
                            </option>
                        @endforeach

                    </select>
                    @if(count($errors) && $errors->first('rgi_id'))
                        <div class="badge badge-danger">
                            {{ $errors->first('rgi_id') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label for="type_housing">{{ __('default/views.type_housing') }}</label>
                    <select required class="custom-select" id="type_housing" name="type_housing"
                            value="{{ old('type_housing') }}">
                        <option selected disabled value="0">{{ __('default/views.selectOption') }}</option>
                        <option @if($family_setting->type_housing == "CP") selected="selected"
                                @endif value="CP">Casa Própria
                        </option>
                        <option @if($family_setting->type_housing == "CA") selected="selected"
                                @endif value="CA">Casa Alugada
                        </option>
                        <option @if($family_setting->type_housing == "CF") selected="selected"
                                @endif value="CF">Casa de Favor
                        </option>
                        <option @if($family_setting->type_housing == "A") selected="selected"
                                @endif value="A">Abrigo
                        </option>
                    </select>
                    @if(count($errors) && $errors->first('type_housing'))
                        <div class="badge badge-danger">
                            {{ $errors->first('type_housing') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-md-6 ">
                    <label for="rent_value">{{ __('default/views.rent_value') }}</label>
                    <input type="number" class="form-control" id="rent_value" name="rent_value"
                           value="{{ old('rent_value', $family_setting->rent_value) }}">
                    @if(count($errors) && $errors->first('rent_value'))
                        <div class="badge badge-danger">
                            {{ $errors->first('rent_value') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-md-6 ">
                    <span>{{ __('default/views.family_bag') }}</span>
                    <div class="custom-control custom-radio">
                        <input @if($family_setting->family_bag) checked="checked" @endif type="radio"
                               id="family_bag_true" name="family_bag" value="1" class="custom-control-input">
                        <label class="custom-control-label" for="family_bag_true">{{ __('default/views.1') }}</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input @if(!$family_setting->family_bag) checked="checked" @endif type="radio"
                               id="family_bag_false" name="family_bag" value="0" class="custom-control-input">
                        <label class="custom-control-label" for="family_bag_false">{{ __('default/views.0') }}</label>
                    </div>
                </div>
                <div class="form-group col-md-6 ">
                    <label for="value_bag">{{ __('default/views.value_bag') }}</label>
                    <input type="number" class="form-control" id="value_bag" name="value_bag"
                           value="{{ old('value_bag', $family_setting->value_bag) }}">
                    @if(count($errors) && $errors->first('value_bag'))
                        <div class="badge badge-danger">
                            {{ $errors->first('value_bag') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-md-6 ">
                    <span>{{ __('default/views.inss_benefit') }}</span>
                    <div class="custom-control custom-radio">
                        <input @if($family_setting->inss_benefit) checked="checked" @endif type="radio"
                               id="inss_benefit_true" name="inss_benefit" value="1" class="custom-control-input">
                        <label class="custom-control-label" for="inss_benefit_true">{{ __('default/views.1') }}</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input @if(!$family_setting->inss_benefit) checked="checked" @endif type="radio"
                               id="inss_benefit_false" name="inss_benefit" value="0" class="custom-control-input">
                        <label class="custom-control-label" for="inss_benefit_false">{{ __('default/views.0') }}</label>
                    </div>
                </div>
                <div class="form-group col-md-6 ">
                    <label for="value_inss_benefit">{{ __('default/views.value_inss_benefit') }}</label>
                    <input type="number" class="form-control" id="value_inss_benefit" name="value_inss_benefit"
                           value="{{ old('value_inss_benefit', $family_setting->value_inss_benefit) }}">
                    @if(count($errors) && $errors->first('value_inss_benefit'))
                        <div class="badge badge-danger">
                            {{ $errors->first('value_inss_benefit') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-md-6 ">
                    <span>{{ __('default/views.pension') }}</span>
                    <div class="custom-control custom-radio">
                        <input @if($family_setting->pension) checked="checked" @endif type="radio" id="pension_true"
                               name="pension" value="1" class="custom-control-input">
                        <label class="custom-control-label" for="pension_true">{{ __('default/views.1') }}</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input @if(!$family_setting->pension) checked="checked" @endif type="radio" id="pension_false"
                               name="pension" value="0" class="custom-control-input">
                        <label class="custom-control-label" for="pension_false">{{ __('default/views.0') }}</label>
                    </div>
                </div>
                <div class="form-group col-md-6 ">
                    <label for="pension_amount">{{ __('default/views.pension_amount') }}</label>
                    <input type="number" class="form-control" id="pension_amount" name="pension_amount"
                           value="{{ old('pension_amount', $family_setting->pension_amount) }}">
                    @if(count($errors) && $errors->first('pension_amount'))
                        <div class="badge badge-danger">
                            {{ $errors->first('pension_amount') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-md-6 ">
                    <label for="drug_spending">{{ __('default/views.drug_spending') }}</label>
                    <input type="number" class="form-control" id="drug_spending" name="drug_spending"
                           value="{{ old('drug_spending', $family_setting->drug_spending) }}">
                    @if(count($errors) && $errors->first('drug_spending'))
                        <div class="badge badge-danger">
                            {{ $errors->first('drug_spending') }}
                        </div>
                    @endif
                </div>
            </div>
        </form>
    </div>
@endsection
