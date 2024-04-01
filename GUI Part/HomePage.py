from customtkinter import *
import ctypes

class HomePageApp(CTk):
    width = 0
    height = 0


    def __init__(self, width, height, title):
        super().__init__()
        self.width = width
        self.height = height
        self.title(title)
       

    def setCenterWindow(self):
        scaleFactor = ctypes.windll.shcore.GetScaleFactorForDevice(0) / 100

        screen_width = self.winfo_screenwidth()
        screen_height = self.winfo_screenheight()
        x = round(((screen_width - self.width) // 2) * scaleFactor)
        y = round(((screen_height - self.height) // 2) * scaleFactor)

        self.geometry('{}x{}+{}+{}'.format(self.width, self.height, x, y))


    def setComponents(self):
        self.columnconfigure(index = 0, weight = 1)
        self.columnconfigure(index = 1, weight = 4)
        self.rowconfigure(index = 0, weight = 1)

        buttonFrame = CTkFrame(master = self, fg_color = 'red')
        buttonFrame.rowconfigure(index = 0, weight = 1)
        buttonFrame.rowconfigure(index = 1, weight = 1)
        buttonFrame.rowconfigure(index = 2, weight = 1)
        buttonFrame.columnconfigure(index = 0, weight = 1)

        mainFrame = CTkFrame(master = self, fg_color = 'blue')

        loadFileButton = CTkButton(master = buttonFrame, text = "Load File", command = self.loadFileButtonClick)
        loadFileButton.grid(row = 0, column = 0)

        generateModelButton = CTkButton(master = buttonFrame, text = "Generate Model", command = self.loadFileButtonClick)
        generateModelButton.grid(row = 1, column = 0)

        showGraphButton = CTkButton(master = buttonFrame, text = "Show Graphs", command = self.loadFileButtonClick)
        showGraphButton.grid(row = 2, column = 0)

        buttonFrame.grid(row = 0, column = 0, sticky = 'nsew')
        mainFrame.grid(row = 0, column = 1, sticky = 'nsew')


    def loadFileButtonClick(self):
        print("Hello Buddy")    

      