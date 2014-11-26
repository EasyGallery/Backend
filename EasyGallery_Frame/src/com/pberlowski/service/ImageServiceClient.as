package com.pberlowski.service
{
	import flash.display.InteractiveObject;
	import mx.messaging.Channel;
	import mx.messaging.channels.AMFChannel;
	import mx.messaging.ChannelSet;
	import mx.rpc.AsyncToken;
	import mx.rpc.remoting.RemoteObject;
	
	/**
	 * ...
	 * @author Piotr Berlowski
	 */
	public class ImageServiceClient
	{
		
		private var ro:RemoteObject;
		
		public function ImageServiceClient(endpointUri:String)
		{
			var c:Channel = new AMFChannel("amfphp", endpointUri);
			var cs:ChannelSet = new ChannelSet();
			cs.addChannel(c);
			ro = new RemoteObject("amfphp");
			ro.source = "EasyGallery_ImageService";
			ro.channelSet = cs;
		}
		
		public function get_image(code:String):AsyncToken
		{
			return ro.get_image(code);
		}
	
	}

}