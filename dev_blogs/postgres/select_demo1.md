~~~

    京]Andy
    select 
    '
    select ''insert into ''|| '''||schemaname||''' ||''.''|| '''||tablename||''' ||''( '' 
    union all
    select * from (select 
            c.column_name||'',''
      from information_schema.columns c, information_schema.information_schema_catalog_name iscn
     where c.table_catalog = iscn.catalog_name
       and c.table_schema  = '''||schemaname||'''
       and c.table_name    = '''||tablename||'''
     order by c.table_schema, c.table_name, c.ordinal_position ) col
    union all
    select '' ) values ( ''
    union all
    select * from 
    (select 
           case 
            when c.data_type=''character'' then ''''''''||''a''||'''''',''
            when c.data_type=''character varying'' then ''''''''||''b''||'''''',''
            when c.data_type=''timestamp without time zone'' then ''''''''||''2015-09-09''||'''''',''
            when c.data_type=''numeric'' then 1||'',''
            else ''?''
           end 
      from information_schema.columns c, information_schema.information_schema_catalog_name iscn
     where c.table_catalog = iscn.catalog_name
       and c.table_schema  = '''||schemaname||'''
       and c.table_name    = '''||tablename||'''
     order by c.table_schema, c.table_name, c.ordinal_position ) val 
    union all
    select '' ); '';
    '
    from pg_tables where schemaname='mon';


~~~