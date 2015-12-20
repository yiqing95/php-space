安装器

实现涉及

-   模式引入 表结构在db中的生成
-   数据的导入 为了能够运转模块|app 必要的初始数据
-   关系的建立

卸载功能
    还原安装的影响 
    实现回滚效应
    
~~~

    namespace Magento\Framework\Setup;
    
    /**
     * Interface for DB schema installs of a module
     */
    interface InstallSchemaInterface
    {
        /**
         * Installs DB schema for a module
         *
         * @param SchemaSetupInterface $setup
         * @param ModuleContextInterface $context
         * @return void
         */
        public function install(SchemaSetupInterface $setup, ModuleContextInterface $context);
    }
~~~