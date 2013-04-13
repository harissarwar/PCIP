package bytesol.pcip.events
{
import flash.events.Event;

public class ColorEvent extends Event
{
  public static const COLOR:String = "color";
  public var seat:String = ""
  public var color:String = "";
    
  public function ColorEvent(type:String, seat:String, color:String)
  {
    super(type);
    this.seat = seat;
    this.color = color;
  }
  
  override public function clone():Event
  {
    return new ColorEvent(type, seat, color);
  }
}
}