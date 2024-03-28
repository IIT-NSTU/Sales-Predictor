from LoadingPage import LoadingPageApp
from HomePage import HomePageApp

loadingPageApp = LoadingPageApp(500, 400)
loadingPageApp.setCenterWindow()
loadingPageApp.setLabels()
loadingPageApp.setProgressbar()
loadingPageApp.mainloop()

homePageApp = HomePageApp(800, 500, "Sales Predictor")
homePageApp.setCenterWindow()
homePageApp.mainloop()