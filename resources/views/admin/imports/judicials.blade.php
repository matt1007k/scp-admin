@extends('layouts.side-menu')

@section('head', 'Importar Judiciales')

@section('subcontent')

<div>
  <div class="intro-x mt-10 flex items-center h-10">
    <h1 class="text-xl font-medium truncate mr-5">Importar Judiciales</h1>
  </div>

  <div class="mt-5 w-full border-b-2 border-gray-300 dark:border-slate-700 flex flex-col justify-center items-center gap-5" x-data="ImportJudicials" x-init"init">
    <div class="dropzone w-full md:w-2/4 hover:bg-gray-100 dark:hover:bg-slate-800">
      <input type="file" x-model="file" x-ref="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" class="input-file" :class="progress === 100 || 'cursor-pointer'" />
      <template x-if="!uploading">
        <p class="grid place-items-center gap-2">
          <x-feathericon-upload class="h-10 w-10" />
          <span>Seleccione un archivo Excel</span>
        </p>
      </template>
      <template x-if="uploading">
        <div>
          <div class="flex justify-center gap-1 text-lg">
            <span x-text="progress"></span>
            <span>%</span>
          </div>
          <div class="h-1 w-full bg-gray-200">
            <div class="h-full bg-blue-500" :style="{ width: `${progress}%` }"></div>
          </div>
        </div>
      </template>
    </div>
    <template x-if="progress === 100">
      <div>
        <p class="text--secondary subheading font-weight-semibold mt-2">
          Subiendo los datos espere:
        </p>
        <div class="spinner">
          <div class="rect1 dark:bg-gray-200"></div>
          <div class="rect2 dark:bg-gray-200"></div>
          <div class="rect3 dark:bg-gray-200"></div>
          <div class="rect4 dark:bg-gray-200"></div>
          <div class="rect5 dark:bg-gray-200"></div>
        </div>
      </div>
    </template>
    <div class="w-full sm:w-auto grid gap-2">
      <template x-if="error">
        <x-alert type="error" x-text="errors.archivo[0]"></x-alert>
      </template>
      <template x-if="uploadFile.length > 0">
        <x-alert type="success">
          <template x-for="upFile in uploadFile" :key="upFile.name">
            <li x-text="getFileUploaded(upFile)"></li>
          </template>
        </x-alert>
      </template>
    </div>

  </div>

</div>


@endsection
