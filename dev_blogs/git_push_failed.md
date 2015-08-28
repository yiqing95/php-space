push不到github 
============

网上搜索下 


解决方案：
[http://blog.csdn.net/robertsong2004/article/details/38225933](http://blog.csdn.net/robertsong2004/article/details/38225933
)
>
    2014-07-28 10:49 1799人阅读 评论(0) 收藏 举报
    
    问题描述：
    
    $ git push
    
    error: The requested URL returned error: 403 Forbidden while accessing
    
    解决方案：
    
    这是权限问题，可以修改.git/config文件追加用户名和密码
    
    详细：
    
    From:http://stackoverflow.com/questions/7438313/pushing-to-git-returning-error-code-403-fatal-http-request-failed
    
    To definitely be able to login using https protocol, you should first set your authentication credential to the git Remote URI:
    
    git remote set-url origin https://yourusername@github.com/user/repo.git
    
    Then you'll be asked for a password when trying to git
     push.
    
    In fact, this is on the http authentication format. You could set a password too:
    
    https://youruser:password@github.com/user/repo.git
    
    You should be aware that if you do this, your github password will be stored in plaintext in your .git directory, which is obviously undesirable.
