There are 2 installations for use with BankMidwest, both of which reside in the same account on Bluehost

- Staging [ staging.bankmidwest.com ]
- Production [ www.bankmidwest.com ]

Deployment of theme files is handled by WP Pusher, a plugin that retrieves the themefiles from github and deploys them to the desired location.

1. Log into the appropriate enviorment.
2. Go to Dashboard -> WP Pusher -> Themes
3. Click "Edit Theme" for the theme you are working on
4. Select "Push-to-Deploy" to turn on automatic deployment.
    - All pushes to this repo [staging for staging, master for production] will cause the theme [ Desktop or Mobile ] to deploy to the site
5. When you are finished De-Select "Push-to-Deploy"

Be sure to Branch off Master to a new development branch [ feature-{yourname}-{name of work} ]. merge into staging to deploy to staging site.

Once your changes are approved merge into the master branch to deploy to production enviorment. 

Delete your development branch.
