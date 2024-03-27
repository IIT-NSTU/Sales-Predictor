from tkinter import font
from customtkinter import *
import ctypes

#Creating the application main window.
window = CTk()

window.title("Sales Predictor")

#Window Height and Width.
width = 500
height = 400

#Scale Factor
scaleFactor = ctypes.windll.shcore.GetScaleFactorForDevice(0) / 100

#Placing the window in the middle of the screen.
screen_width = window.winfo_screenwidth()
screen_height = window.winfo_screenheight()
x = round(((screen_width - width) // 2) * scaleFactor)
y = round(((screen_height - height) // 2) * scaleFactor)

#Set the geometry.
window.geometry('{}x{}+{}+{}'.format(width, height, x, y))

titleFont = CTkFont(family='Brush Script MT', size=60)
subtitleFont = CTkFont(family='Brush Script MT', size=36)

inputFrame = CTkFrame(window, fg_color = "transparent")

CTkLabel(inputFrame,
         text = "Sales Predictor",
         font = titleFont,
         fg_color = "transparent").pack()

CTkLabel(inputFrame,
         text = "By Prosanto Deb",
         font = subtitleFont,
         fg_color = "transparent").pack(side=RIGHT, pady=10)

inputFrame.pack(pady = 75)

window.after(2000, lambda:window.destroy())

progessbar = CTkProgressBar(window, orientation="horizontal",mode="determinate", determinate_speed=0.75)
progessbar.set(0)
progessbar.pack()

# Starting the progress bar
progessbar.start()

# Removes the window's title bar
window.overrideredirect(True)

#Entering the event main loop.
window.mainloop()