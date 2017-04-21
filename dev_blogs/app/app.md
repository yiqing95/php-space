应用程序应具有的特征：

-  前端 后端 控制台 应用

-  入口文件
    +  运行模式探测
    +  bootstrap
    +  config 
    +  异常处理器 
    
    +   应用启动  run

-  安装功能
-  注册功能 跟安装可认为是同义语
    如果自己是一个模块 或者整个系统中的一部分 那么要实现注册功能 这样能够使别的模块|子系统 可以跟之交互
    

-  application 
   就是module 跟其他module最好一致对待
   
   监听bootstrap事件
   有自己的配置
   >    
            class Module implements
            BootstrapListenerInterface,
            ConfigProviderInterface
## 控制器
            
   控制器集合
               
   控制器
        
        动作
        
         ~~~
            
             /**
                 * Result of checking DB credentials
                 *
                 * @return JsonModel
                 */
                public function indexAction()
                {
                    try {
                        $params = Json::decode($this->getRequest()->getContent(), Json::TYPE_ARRAY);
                        $password = isset($params['password']) ? $params['password'] : '';
                        $this->dbValidator->checkDatabaseConnection($params['name'], $params['host'], $params['user'], $password);
                        $tablePrefix = isset($params['tablePrefix']) ? $params['tablePrefix'] : '';
                        $this->dbValidator->checkDatabaseTablePrefix($tablePrefix);
                        return new JsonModel(['success' => true]);
                    } catch (\Exception $e) {
                        return new JsonModel(['success' => false, 'error' => $e->getMessage()]);
                    }
                }
         ~~~
         
         默认动作 index | default 
         
         api返回
         ~~~
            
            namespace Magento\Setup\Controller;
            
            interface ResponseTypeInterface
            {
                /**#@+
                 * Response Type values
                 */
                const RESPONSE_TYPE_SUCCESS = 'success';
                const RESPONSE_TYPE_ERROR = 'error';
                /**#@-*/
            }
         ~~~
         
         action的返回值类型
         在yii1时代 action是没有返回值的 直接是输出到浏览器（echo 或者 include 视图 均属于此）
         在yii2时代 action是被捕获的 （一般是字符串）  这样做是可以对返回值进行“后加工-- post-process”可以应用类似angular
         中的 formatter或 interceptor 的逻辑   (formatter 只做beforeRequest 和afterResponse 修改  而 interceptor是可以
         before/after 都可以  就是在标准请求和返回处理的前后围绕一个一些逻辑)
         @@@@
           @@@
             @@@@@ 
                   before-Request
             %%%%%
           %%%
         %%%%          
                           <<Request>>
                         --------------->               
                                                       -------------------- 
                                                       |                  |
                                                       |   server process
                                                      /
                                                    /
                                                  /--------------------    
                         <-----------------
                            <<Response>>
         %%%%
           %%%
             %%%%%          
                   afterResponse      
             @@@@@     
           @@@                                                            
         @@@@
         
## view
视图
    layout
    errors
    views
        按控制器id | 模块   归组存放
### blocks | widgets | ui-components
   表示层中的 功能块 小组件 
    逻辑功能单元         
        
## i18n

## 模型

验证
AR 关系   1:1 1:N  M:N
索引

AR分裂（CQRS 命令行请求责任分离）：
    在CQRS模式中 AR有两个构成  一个只负责读 另一个只负责写  并且使用不同的底层数据源
    读的哪个底层数据源 很有可能是nosql 或者搜索引擎系统
    写的哪个底层数据源 经常是RDBMS系统（mysql postgres oracle等）
    
## Observers | Listeners
   事件监听
    + 包括监听内部事件
    + 模块间事件的监听

## 帮助类

    静态类
    在ROR（Ruby On Rails）中 程序员的工作流程主要就是在 MVC+helper之间忙碌的
    
    
## 工具类 Util

    仿GNU中utils 工具集的命名 或者功能来由
    
## 维护性功能
    Cron
    ~~~
    
        namespace Magento\Backend\Cron;
        
        /**
         * Backend event observer
         */
        class CleanCache
        {
            /**
             * @var \Magento\Framework\App\Cache\Frontend\Pool
             */
            private $cacheFrontendPool;
        
            /**
             * @param \Magento\Framework\App\Cache\Frontend\Pool $cacheFrontendPool
             */
            public function __construct(
                \Magento\Framework\App\Cache\Frontend\Pool $cacheFrontendPool
            ) {
                $this->cacheFrontendPool = $cacheFrontendPool;
            }
        
            /**
             * Cron job method to clean old cache resources
             *
             * @return void
             */
            public function execute()
            {
                /** @var $cacheFrontend \Magento\Framework\Cache\FrontendInterface */
                foreach ($this->cacheFrontendPool as $cacheFrontend) {
                    // Magento cache frontend does not support the 'old' cleaning mode, that's why backend is used directly
                    $cacheFrontend->getBackend()->clean(\Zend_Cache::CLEANING_MODE_OLD);
                }
            }
        }
    
    ~~~
    
    
## 测试
   单元
   功能
   集成测试
   可接受测试 E2E（end to end）点对点
    
    
    
        
        