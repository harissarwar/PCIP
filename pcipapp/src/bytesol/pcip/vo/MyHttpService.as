package bytesol.pcip.vo
{
import flash.events.Event;
import flash.events.EventDispatcher;
import flash.events.HTTPStatusEvent;
import flash.events.IOErrorEvent;
import flash.events.ProgressEvent;
import flash.events.SecurityErrorEvent;
import flash.net.URLLoader;
import flash.net.URLLoaderDataFormat;
import flash.net.URLRequest;
import flash.net.URLRequestHeader;
import flash.net.URLRequestMethod;

import mx.managers.CursorManager;

[Event(name="success", type="flash.events.Event")]
[Event(name="fail", type="flash.events.Event")]
[Bindable]
public class MyHttpService extends EventDispatcher
{
  private var req:URLRequest = new URLRequest();
  private var loader:URLLoader = new URLLoader();
  private var _statusCode:int = 0;
  private var _respHdrs:Array = [];
  
  public var url:String = "";
  
  public function MyHttpService()
  {
    req.method = URLRequestMethod.POST;
    req.requestHeaders = [ new URLRequestHeader("X-Requested-With", "XMLHttpRequest") ];
    loader.addEventListener(Event.COMPLETE, completeHandler);
    loader.addEventListener(SecurityErrorEvent.SECURITY_ERROR, securityErrorHandler);
    loader.addEventListener(HTTPStatusEvent.HTTP_STATUS, httpStatusHandler);
    loader.addEventListener(IOErrorEvent.IO_ERROR, ioErrorHandler);
//    loader.addEventListener(Event.OPEN, openHandler);
//    loader.addEventListener(ProgressEvent.PROGRESS, progressHandler);
  }
  
  public function send(data:Object="", format:String=URLLoaderDataFormat.TEXT):void
  {
    req.url = url;
    loader.dataFormat = format; 
    _statusCode = 0;
    _respHdrs = [];
    if(format == URLLoaderDataFormat.TEXT)
    {
      var str:String = String(data)
      if(str.length > 0)
        req.data = data + "&ajax=1";
      else
        req.data = "ajax=1";
    }
    else
      req.data = data;
    trace("URL:", req.url);
    trace("Data:", req.data);
    loader.load(req); 
    CursorManager.setBusyCursor();
  }
  
  private function completeHandler(event:Event):void 
  {
//    if(statusCode != 0 && statusCode != 200)
//      dispatchEvent(new Event("fail"));
//    else
      dispatchEvent(new Event("success"));
//    trace("completeHandler: " + loader.data);
      CursorManager.removeBusyCursor();
  }
  
  public function get response():Object
  {
    return loader.data;
  }
//  private function openHandler(event:Event):void 
//  {
//    trace("openHandler: " + event);
//  }
  
//  private function progressHandler(event:ProgressEvent):void 
//  {
//    trace("progressHandler loaded:" + event.bytesLoaded + " total: " + event.bytesTotal);
//  }
  
  public function get statusCode():int
  {
    return _statusCode;
  }
  
  public function get respHeaders():Array
  {
    return _respHdrs; 
  }
  private function httpStatusHandler(event:HTTPStatusEvent):void 
  {
    _statusCode = event.status;
//    _respHdrs = event.responseHeaders;
//    trace("httpStatusHandler: " + event);
  }
  
  private function ioErrorHandler(event:IOErrorEvent):void 
  {
    CursorManager.removeBusyCursor();
    dispatchEvent(new Event("fail"));
//    trace("ioErrorHandler: " + event);
  }
  
  private function securityErrorHandler(event:SecurityErrorEvent):void 
  {
    CursorManager.removeBusyCursor();
    dispatchEvent(new Event("fail"));
    //    trace("securityErrorHandler: " + event);
  }
}
}