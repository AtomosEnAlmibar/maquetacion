@php
    use App\Models\Db\Faq;
@endphp

<div class="table-filter" id="table-filter">
    <div class="table-filter-container encogido">  
        
        @switch($route)
            @case('faqs')
                <form class="filter-form" id="filter-form" action="{{route("faqs_filter")}}" autocomplete="off">             

                    {{ csrf_field() }}
        
        
                    @foreach ($filters as $key => $items)
        
                        @if($key == 'category')
                            <div class="one-column">
                                <div class="form-group">
                                    <div class="form-label">
                                        <label for="category_id" class="label-highlight">Filtrar por categoría</label>
                                    </div>
                                    <div class="form-input">
                                        <select name="category_id" data-placeholder="Seleccione una categoría" class="input-highlight">
                                            <option value="all">Todas</option>
                                            @foreach($items as $item)
                                                @if (count(Faq::where('category_id', $item->id)->get()) > 0)
                                                    <option value="{{$item->id}}" >{{ $item->name }}</option>    
                                                @else
                                                    <option value="{{$item->id}}" disabled>{{ $item->name }}</option>    
                                                @endif
                                                
                                            @endforeach
                                        </select>    
                                    </div>
                                </div>
                            </div>    
                        @endif
        
                        @if($key == 'date')
                            <div class="one-column">
                                <div class="form-group">
                                    <div class="form-label">
                                        <label for="init_date" class="label-highlight">Desde:</label>
                                    </div>
                                    <div class="form-input">
                                        <input type="date" name="init_date" class="input-highlight" value="" @isset($items[0]->created_at) min={{$items[0]->created_at}} max={{$items[count($items)-1]->created_at}} @endif>                                
                                    </div>
                                    <div class="form-label">
                                        <label for="final_date" class="label-highlight">Hasta:</label>
                                    </div>
                                    <div class="form-input">
                                        <input type="date" name="final_date" class="input-highlight" value="" @isset($items[0]->created_at) min={{$items[0]->created_at}} max={{$items[count($items)-1]->created_at}} @endif>                                
                                    </div>
                                </div>
                            </div>    
                        @endif
        
                        @if($key == 'search')
                            <div class="one-column">
                                <div class="form-group">
                                    <div class="form-label">
                                        <label for="search" class="label-highlight">Buscar palabra</label>
                                    </div>
                                    <div class="form-input">
                                        <input type="text" name="search" class="input-highlight" value="">
                                    </div>
                                </div>
                            </div>    
                        @endif                
        
                    @endforeach
                        
                </form>            
                @break
            @case('sliders')
                <form class="filter-form" id="filter-form" action="{{route("sliders_filter")}}" autocomplete="off">             

                    {{ csrf_field() }}
        
        
                    @foreach ($filters as $key => $items)                        
        
                        @if($key == 'date')
                            <div class="one-column">
                                <div class="form-group">
                                    <div class="form-label">
                                        <label for="init_date" class="label-highlight">Desde:</label>
                                    </div>
                                    <div class="form-input">
                                        <input type="date" name="init_date" class="input-highlight" value="" @isset($items[0]->created_at) min={{$items[0]->created_at}} max={{$items[count($items)-1]->created_at}} @endif>
                                    </div>
                                    <div class="form-label">
                                        <label for="final_date" class="label-highlight">Hasta:</label>
                                    </div>
                                    <div class="form-input">
                                        <input type="date" name="final_date" class="input-highlight" value="" @isset($items[0]->created_at) min={{$items[0]->created_at}} max={{$items[count($items)-1]->created_at}} @endif>
                                    </div>
                                </div>
                            </div>    
                        @endif
        
                        @if($key == 'search')
                            <div class="one-column">
                                <div class="form-group">
                                    <div class="form-label">
                                        <label for="search" class="label-highlight">Buscar palabra</label>
                                    </div>
                                    <div class="form-input">
                                        <input type="text" name="search" class="input-highlight" value="">
                                    </div>
                                </div>
                            </div>    
                        @endif                
        
                    @endforeach
                        
                </form>
                @break
            @default
                
        @endswitch
    
    </div>
    <div class="table-filter-buttons">
        <div class="table-filter-button open-filter button-active" id="open-filter">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel-fill" viewBox="0 0 16 16">
                <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2z"/>
            </svg>
        </div>
        <div class="table-filter-button apply-filter" id="apply-filter">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel-fill" viewBox="0 0 16 16">
                <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2z"/>
            </svg>
        </div>
    </div>
</div>

{{-- <div class="filters-container">

    
    <div class="filters-container-second-group">
        <div class="filter-buttons">
            @isset($order_route)
                <svg xmlns="http://www.w3.org/2000/svg" class="filter-button order-button" route="{{route($order_route)}}" viewBox="0 0 24 24">
                    <path class="order-button-icon" d="M14 5h8v2h-8zm0 5.5h8v2h-8zm0 5.5h8v2h-8zM2 11.5C2 15.08 4.92 18 8.5 18H9v2l3-3-3-3v2h-.5C6.02 16 4 13.98 4 11.5S6.02 7 8.5 7H12V5H8.5C4.92 5 2 7.92 2 11.5z"/>
                    <path fill="none" d="M0 0h24v24H0z"/>
                </svg>
            @endif
    
            @isset($date_filter)
                <svg xmlns="http://www.w3.org/2000/svg" class="filter-button daterange-button" viewBox="0 0 24 24">
                    <path class="daterange-button-icon" d="M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zm2-7h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11z"/>
                    <path fill="none" d="M0 0h24v24H0z"/>
                </svg>
            @endisset

            @isset($import)
                <svg viewBox="0 0 24 24" class="filter-button import-button"  route="{{route($import)}}">
                    <path d="M17.65,6.35C16.2,4.9 14.21,4 12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20C15.73,20 18.84,17.45 19.73,14H17.65C16.83,16.33 14.61,18 12,18A6,6 0 0,1 6,12A6,6 0 0,1 12,6C13.66,6 15.14,6.69 16.22,7.78L13,11H20V4L17.65,6.35Z" />
                </svg>
            @endif

            @isset($ping)
                <svg style="width:2em;height:2em;margin-top: 0.25em;" viewBox="0 0 24 24" class="filter-button google-button" data-route="{{route($ping)}}">
                    <path d="M21.35,11.1H12.18V13.83H18.69C18.36,17.64 15.19,19.27 12.19,19.27C8.36,19.27 5,16.25 5,12C5,7.9 8.2,4.73 12.2,4.73C15.29,4.73 17.1,6.7 17.1,6.7L19,4.72C19,4.72 16.56,2 12.1,2C6.42,2 2.03,6.8 2.03,12C2.03,17.05 6.16,22 12.25,22C17.6,22 21.5,18.33 21.5,12.91C21.5,11.76 21.35,11.1 21.35,11.1V11.1Z" />
                </svg>
            @endif   
        </div>

        @isset($subfilter)
            <div class="subfilter-select-container"> 
                <select 
                    id="subfilter" 
                    class="filter-select form-control primary-select-related">
                        <option value="todas">Todas</option>
                        @foreach($subfilter as $subfilter_input)
                            <option value="{{$subfilter_input->id}}" name='{{$subfilter_input->name}}'>{{$subfilter_input->name}}</option>
                        @endforeach
                </select>
            </div>
        @endisset     
        
    </div>

</div> --}}