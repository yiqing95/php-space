push����github 
============

���������� 


���������
[http://blog.csdn.net/robertsong2004/article/details/38225933](http://blog.csdn.net/robertsong2004/article/details/38225933
)
>
    2014-07-28 10:49 1799���Ķ� ����(0) �ղ� �ٱ�
    
    ����������
    
    $ git push
    
    error: The requested URL returned error: 403 Forbidden while accessing
    
    ���������
    
    ����Ȩ�����⣬�����޸�.git/config�ļ�׷���û���������
    
    ��ϸ��
    
    From:http://stackoverflow.com/questions/7438313/pushing-to-git-returning-error-code-403-fatal-http-request-failed
    
    To definitely be able to login using https protocol, you should first set your authentication credential to the git Remote URI:
    
    git remote set-url origin https://yourusername@github.com/user/repo.git
    
    Then you'll be asked for a password when trying to git
     push.
    
    In fact, this is on the http authentication format. You could set a password too:
    
    https://youruser:password@github.com/user/repo.git
    
    You should be aware that if you do this, your github password will be stored in plaintext in your .git directory, which is obviously undesirable.
