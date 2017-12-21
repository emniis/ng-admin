<?php

namespace Emniis\NgAdmin\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeNgAdminCrud extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'nga:crud {crud} {colonnes}';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Generate CRUD for ng admin ui';

  public $crud_name = [];

  protected $cols =[];

  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct()
  {
      parent::__construct();
  }

  public function handle()
  {
      $this->initData();
      $this->genController();
      $this->genRequest();
      $this->genViews();
      $this->genModel();
      $this->genRoute();
      $this->genNgScripts();
  }

  private function getStubPath()
  {

      return __DIR__.'/../../Stubs';
  }
  protected function getDefaultNamespaceController($rootNamespace)
  {
      return $rootNamespace.'Http\Controllers\Admin';
  }
  protected function getRealpathBase($directory)
  {
      return realpath(base_path($directory));
  }

  protected function getDefaultNamespaceRequest($rootNamespace)
  {
      return $rootNamespace.'Http\Requests';
  }

  protected function initData()
  {
    $crud = $this->argument('crud');
    $this->crud_name['crud'] = $crud;
    $this->crud_name['singular']=str_singular($crud);
    $this->crud_name['plural']=str_plural($crud);
    $this->crud_name['views_folder']= 'ng-admin';
    $this->crud_name['controller']=ucfirst($this->crud_name['singular']).'Controller';
    $this->crud_name['request']=ucfirst($this->crud_name['singular']).'Request';
    $this->crud_name['model']=ucfirst($this->crud_name['singular']);
    $this->crud_name['route']=$this->crud_name['plural'];
    $this->crud_name['ng_service']=ucfirst($this->crud_name['singular']).'Service';
    $this->crud_name['ng_controller']=$this->crud_name['controller'];
    $this->crud_name['ng_router']=$this->crud_name['route'];
    $this->crud_name['ng_event']=ucfirst($this->crud_name['singular']).'Refresh';

    $colonnes = $this->argument('colonnes');
    if($colonnes=='')
        $this->cols=[];
    else
        $this->cols=explode(',', $colonnes);
  }

  protected function genController(){
    $controller_stub= file_get_contents($this->getStubPath().'/controller.stub');
    $controller_stub = str_replace('DummyClass', $this->crud_name['controller'], $controller_stub);
    $controller_stub = str_replace('DummyModel', $this->crud_name['model'], $controller_stub);
    $controller_stub = str_replace('DummyVariableSing', $this->crud_name['singular'], $controller_stub);
    $controller_stub = str_replace('DummyVariable', $this->crud_name['plural'], $controller_stub);
    $controller_stub = str_replace('DummyNamespace', $this->getDefaultNamespaceController($this->laravel->getNamespace()), $controller_stub);
    $controller_stub = str_replace('DummyRootNamespace', $this->laravel->getNamespace(), $controller_stub);

    $colonnes = $this->cols;

    $cols='';

    foreach ($colonnes as $colonne){
        $cols.='DummyCreateVariableSing$->'.trim($colonne).'=$request->input(\''.trim($colonne).'\');'."\n\t";
    }
    $controller_stub = str_replace('DummyUpdate', $cols, $controller_stub);
    $controller_stub = str_replace('DummyCreateVariable$', '$'.$this->crud_name['plural'], $controller_stub);
    $controller_stub = str_replace('DummyCreateVariableSing$', '$'.$this->crud_name['singular'], $controller_stub);

    if(!is_dir($this->getRealpathBase('app/Http/Controllers/Admin').'/'.$this->crud_name['controller'].'.php')){

        file_put_contents($this->getRealpathBase('app/Http/Controllers/Admin').'/'.$this->crud_name['controller'].'.php', $controller_stub);
        $this->info("Created Controller:".$this->crud_name['controller']);

    }else{
      $this->error('Controller '.$this->crud_name['controller'].' already exists');
    }
  }

  protected function genRequest(){
    $rules='';
    $colonnes = $this->cols;
    foreach ($colonnes as $colonne)
    {
        //traitement precedent
        $rules .="'".trim($colonne)."'=>'"."required',\n";
    }
    $request_stub= file_get_contents($this->getStubPath().'/request.stub');
    $request_stub = str_replace('DummyNamespace', $this->getDefaultNamespaceRequest($this->laravel->getNamespace()), $request_stub);
    $request_stub = str_replace('DummyRootNamespace', $this->laravel->getNamespace(), $request_stub);
    $request_stub = str_replace('DummyRulesRequest', $rules, $request_stub);
    $request_stub = str_replace('DummyClass', $this->crud_name['request'], $request_stub);
    if(!file_exists($this->getRealpathBase('app/Http/Requests').'/'.$this->crud_name['request'].'.php')){

        file_put_contents($this->getRealpathBase('app/Http/Requests').'/'.$this->crud_name['request'].'.php', $request_stub);
        $this->info("Created Request: {$this->crud_name['request']}");
    }else{
      $this->error('Request ' .$this->crud_name['request']. ' already exists');
    }

  }

  protected function genModel($migration=true){
    // create model from default comman line
    $this->call('make:model', ['name' => 'Models\\'.$this->crud_name['model']]);

    if($migration){
      $colonnes = $this->cols;
      $fields_migration = '';
      $migration_stub= file_get_contents($this->getStubPath().'/migration.stub');
      $table=snake_case($this->crud_name['plural']);
      $migration_stub= str_replace('DummyTable', $table, $migration_stub);
      $migration_stub= str_replace('DummyClass', studly_case('create_' . $table . '_table'), $migration_stub);
      foreach ($colonnes as $colonne){
          $fields_migration .='$table'."->string('".trim($colonne)."');\n";
      }
      $migration_stub= str_replace('DummyFields', $fields_migration, $migration_stub);
      $date = date('Y_m_d_His');
      file_put_contents(database_path('/migrations/') . $date . '_create_' . $table . '_table.php', $migration_stub);

    }

  }

  protected function genViews(){

    if (!is_dir($this->getRealpathBase('resources/views').'/'.$this->crud_name['views_folder'])){
        mkdir($this->getRealpathBase('resources/views').'/'.$this->crud_name['views_folder'], 0755, true);
        $this->info("Created views directory:". $this->crud_name['views_folder']);
    }else{
      $this->error('Views directory '.$this->crud_name['views_folder'].' already exists');
    }

    $view_stub = file_get_contents($this->getStubPath().'/view.stub');
    $index_view=$tb_detail=$form_fields=$th_index='';
    $colonnes = $this->cols;
    foreach ($colonnes as $colonne)
    {
        //traitement precedent
        $th_index .= "
                    <td data-title=\"'".trim($colonne)."'\" sortable=\"'".trim($colonne)."'\">
                        @{{ row.".trim($colonne)." }}
                    </td>
                      ";
        $tb_detail .= '
                <tr>
                    <th>'.trim($colonne).'</th>
                    <td> @{{ item.'.trim($colonne).' }} </td>
                </tr>
                        ';
        $form_fields .='
                <div class="form-group">
                  <label for="record_'.trim($colonne).'" class="col-sm-3 control-label required">'.trim($colonne).'</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" ng-model="record.'.trim($colonne).'" name="'.trim($colonne).'" id="record_'.trim($colonne).'"
                    validator="required"
                     required-error-message="Obligatoire"
                     required-success-message="&#10003; Ok">
                  </div>
                </div>
                        ';

    }
    $view_stub = str_replace('DummyHeaderTable', $th_index, $view_stub);
    $view_stub = str_replace('DummyFormScope', $this->crud_name['singular'], $view_stub);
    $view_stub = str_replace('DummyRoute', $this->crud_name['plural'], $view_stub);
    $view_stub = str_replace('DummyDetailFields',$tb_detail, $view_stub);
    $view_stub = str_replace('DummyFormFields',$form_fields, $view_stub);

    if (!file_exists($this->getRealpathBase('resources/views').'/'.$this->crud_name['views_folder'].'/'.$this->crud_name['plural'].'.blade.php')) {
        file_put_contents($this->getRealpathBase('resources/views/'.$this->crud_name['views_folder']).'/'.$this->crud_name['plural'].'.blade.php', $view_stub);
        $this->info("Created View: ".$this->crud_name['plural'].".blade.php");
    }else{
        $this->error("View ".$this->crud_name['plural'].".blade.php already exists");
    }

  }


    protected function genNgScripts(){
      $controller_stub= file_get_contents($this->getStubPath().'/angular/controller.stub');
      // $controller_stub = str_replace('DummyClass', $this->crud_name['controller'], $controller_stub);
      $controller_stub = str_replace('DummyController', $this->crud_name['ng_controller'], $controller_stub);
      $controller_stub = str_replace('DummyService', $this->crud_name['ng_service'], $controller_stub);
      $controller_stub = str_replace('DummyEvent', $this->crud_name['ng_event'], $controller_stub);
      $controller_stub = str_replace('DummyClass', $this->crud_name['model'], $controller_stub);

      $cols = $this->cols;
      $fields='';
      $i=1;
      foreach ($cols as $col){
        if(sizeof($cols) == $i){
          $fields.=trim($col).':null'."\n\t";
        }else{
          $fields.=trim($col).':null,'."\n\t";
        }
        $i++;
      }
      $controller_stub = str_replace('DummyFields', $fields, $controller_stub);

      if(!is_dir($this->getRealpathBase('public/ng-admin').'/'.$this->crud_name['singular'].'-controller.js')){

          file_put_contents($this->getRealpathBase('public/ng-admin').'/'.$this->crud_name['singular'].'-controller.js', $controller_stub);
          $this->info("Angular Controller Created :".$this->crud_name['controller']);
          // create service
          $services_content= file_get_contents($this->getRealpathBase('public/ng-admin').'/services.js');
          $service_stub= file_get_contents($this->getStubPath().'/angular/service.stub');
          $gen_part = "/** crudgen dont remove **/";
          $service_stub =  str_replace('DummyService', $this->crud_name['ng_service'], $service_stub);
          $service_stub =  str_replace('DummyRoute', $this->crud_name['route'], $service_stub);
          $new_content = str_replace($gen_part, $service_stub, $services_content);
          file_put_contents($this->getRealpathBase('public/ng-admin').'/services.js', $new_content);
          // create route
          $boot_content= file_get_contents($this->getRealpathBase('public/ng-admin').'/boot.js');
          $route_stub= file_get_contents($this->getStubPath().'/angular/route.stub');
          $gen_part = "/** crudgen dont remove **/";
          $route_stub =  str_replace('DummyRoute', $this->crud_name['route'], $route_stub);
          $route_stub =  str_replace('DummyController', $this->crud_name['controller'], $route_stub);
          $route_stub =  str_replace('DummyFileName', $this->crud_name['singular'], $route_stub);
          $route_stub =  str_replace('DummyTitle', ucfirst($this->crud_name['plural']), $route_stub);
          $new_content = str_replace($gen_part, $route_stub, $boot_content);
          file_put_contents($this->getRealpathBase('public/ng-admin').'/boot.js', $new_content);

      }else{
          $this->error('Angular Controller  '.$this->crud_name['controller'].' already exists');
      }
    }

    protected function genRoute(){
      $route_content= file_get_contents($this->getRealpathBase('routes').'/web.php');
      $gen_part = "/** crudgen routes dont remove this comment **/";
      $new_root = 'Route::resource(\''.$this->crud_name['route'].'\', \'Admin\\'.$this->crud_name['controller'].'\');

      /** crudgen routes dont remove this comment **/';

      $new_content = str_replace($gen_part, $new_root, $route_content);
      file_put_contents($this->getRealpathBase('routes').'/web.php', $new_content);
      $this->info($this->crud_name['route'].' route added ');
    }

}
