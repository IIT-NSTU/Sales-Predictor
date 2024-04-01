from LoadingPage import LoadingPageApp
from LoginPage import LoginPageApp

loadingPageApp = LoadingPageApp(width = 500, height = 400)
loadingPageApp.setCenterWindow()
loadingPageApp.setLabels()
loadingPageApp.setProgressbar()
loadingPageApp.mainloop()

loginPageApp = LoginPageApp(width = 600, height = 450, title = "Sales Predictor")
loginPageApp.setCenterWindow()
loginPageApp.setBackgroundImage()
loginPageApp.setLoginFrame()
loginPageApp.mainloop()