import tkinter as tk

class WindowSwitcher(tk.Tk):
    def __init__(self):
        super().__init__()
        self.geometry("300x200")
        self.title("Window Switcher")
        
        self.label = tk.Label(self, text="Window 1", font=("Arial", 20))
        self.label.pack(pady=50)
        
        self.after(5000, self.switch_windows)  # Switch windows after 5 seconds
        
    def switch_windows(self):
        self.destroy()  # Close current window
        
        # Open new window after 5 seconds
        new_window = NewWindow()
        new_window.mainloop()

class NewWindow(tk.Tk):
    def __init__(self):
        super().__init__()
        self.geometry("300x200")
        self.title("New Window")
        
        self.label = tk.Label(self, text="Window 2", font=("Arial", 20))
        self.label.pack(pady=50)

if __name__ == "__main__":
    window_switcher = WindowSwitcher()
    window_switcher.mainloop()
